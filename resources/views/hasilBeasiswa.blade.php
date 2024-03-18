@extends('layouts.index')

@section('title', 'Hasil Beasiswa')

@section('content')

<style>

    .content-about {
        width: 100%;
        max-width: 736px;
        height: auto;
        flex-shrink: 0;
        margin: 0 auto;
    }

    .status {
        background-color: #fff3cd !important;
        border-radius: 50px !important;
        text-align: center !important;
        font-weight: 600 !important;
        color: #D48E06 !important;
    }

    table th, table td {
        text-align: center;
    }

</style>

    <div class="container-lg mt-8">
        <div class="text-center">
            <h1 class="my-5 text-primary" style="font-weight: 800;">Hasil Beasiswa</h1>
            <img src="images/logo.png" alt="logo" height="100px">
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIM</th>
                      <th scope="col">Email</th>
                      <th scope="col">No. HP</th>
                      <th scope="col">Semester</th>
                      <th scope="col">IPK Terakhir</th>
                      <th scope="col">Jenis Beasiswa</th>
                      <th scope="col">Berkas</th>
                      <th scope="col">Status Ajuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>John Doe</td>
                      <td>123456789</td>
                      <td>john.doe@example.com</td>
                      <td>123-456-7890</td>
                      <td>Semester 3</td>
                      <td>3.4</td>
                      <td>Beasiswa Akademik</td>
                      <td><a href="#">File.pdf</a></td>
                      <td class="status">Belum Diverifikasi</td>
                    </tr>
                    <!-- Add more rows with data as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
@endsection
