<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ipk;
use App\Models\pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DaftarBeasiswaController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function daftar_index()
    {
        return view('daftarBeasiswa');
    }

    public function hasil()
    {
        $data = pendaftaran::orderBy('id', 'DESC')->get();
        return view('hasilBeasiswa', compact('data'));
    }

    public function cek_ipk($nim)
    {
        $cek = ipk::where('nim', $nim)->first();
        return response()->json([
            'status' => $cek ? true : false,
            'ipk' => $cek ? $cek->ipk : 0
        ]);
    }

    public function daftar(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'nim' => 'required',
                'email' => 'required',
                'no_hp' => 'required',
                'berkas' => 'required',
            ]);

            $existingRegistration = pendaftaran::where('nim', $request->nim)->first();

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