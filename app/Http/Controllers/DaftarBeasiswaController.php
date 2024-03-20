<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ipk;
use App\Models\pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DaftarBeasiswaController extends Controller
{
    //fungsi untuk menampilkan tampilan home
    public function index()
    {
        return view('index');
    }

    //fungsi untuk menampilkan halaman daftar beasiswa
    public function daftar_index()
    {
        return view('daftarBeasiswa');
    }

    //fungsi untuk menampilkan hasil
    public function hasil()
    {
        $data = pendaftaran::orderBy('id', 'DESC')->get();

        $jumlahPendaftarAkademik = 0;
        $jumlahPendaftarNonAkademik = 0;

        // Lakukan iterasi terhadap data untuk menghitung jumlah pendaftar berdasarkan jenis beasiswa
        foreach ($data as $pendaftar) {
            if ($pendaftar->beasiswa == 'akademik') {
                $jumlahPendaftarAkademik++;
            } elseif ($pendaftar->beasiswa == 'non_akademik') {
                $jumlahPendaftarNonAkademik++;
            }
        }

        // Kirim hasil perhitungan ke tampilan menggunakan compact
        return view('hasilBeasiswa', compact('data', 'jumlahPendaftarAkademik', 'jumlahPendaftarNonAkademik'));

    }

    //Fungsi untuk mengecek IPK melalui NIM yang tersedia di database
    public function cek_ipk($nim)
    {
        $cek = ipk::where('nim', $nim)->first();
        return response()->json([
            'status' => $cek ? true : false,
            'ipk' => $cek ? $cek->ipk : 0
        ]);
    }

    //fungsi untuk memasukkan data yang sudah disubmit di form
    public function daftar(Request $request)
    {
        try {
            //validasi data
            $request->validate([
                'nama' => 'required',
                'nim' => 'required',
                'email' => 'required',
                'no_hp' => 'required',
                'berkas' => 'required',
            ]);

            $existingRegistration = pendaftaran::where('nim', $request->nim)->first();

            //jika nim sudah terdaftar
            if ($existingRegistration) {

                if ($existingRegistration->beasiswa == $request->beasiswa) {
                    $message = $request->beasiswa == 'akademik'
                        ? 'Anda sudah mendaftar beasiswa akademik.'
                        : 'Anda sudah mendaftar beasiswa non-akademik.';
                    Session::flash('warning', $message);
                    return redirect()->back();
                }
            }

            $data = $request->all();
            $data['status'] = "Belum di verifikasi";

            //fungsi untuk unduh berkas
            if ($request->hasFile('berkas')) {
                $tujuan_upload = public_path('uploads');
                $file = $request->file('berkas');
                $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
                $file->move($tujuan_upload, $namaFile);
                $data['berkas'] = $namaFile;
            }

            pendaftaran::create($data);

            return redirect('hasil')->with('success', "Berhasil Mendaftar");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}