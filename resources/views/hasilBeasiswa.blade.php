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

table th,
table td {
  text-align: center;
}

.chart-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 400px;
}

#myChart {
  width: 800px !important;
  height: 400px !important;
}

@media (max-width: 768px) {
  .chart-container {
    height: auto;

  }

  #myChart {
    width: 100% !important;
    height: auto !important;

  }
}
</style>

<div class="container-lg mt-8">
  <div class="text-center">
    <h1 class="my-5 text-primary" style="font-weight: 800;">Hasil Beasiswa</h1>
    <img src="images/logo.png" alt="logo" height="100px">
  </div>



  <div class="row justify-content-center mt-5">

    @if(session()->has('success'))
    <div class="badge bg-secondary">{{session()->get('success')}}</div>
    @endif

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
            @foreach($data->reverse() as $no => $h)

            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$h->nama}}</td>
              <td>{{$h->nim}}</td>
              <td>{{$h->email}}</td>
              <td>{{$h->no_hp}}</td>
              <td>{{$h->semester}}</td>
              <td>{{$h->ipk}}</td>
              <td>{{$h->beasiswa}}</td>
              <td><a href="{{url('uploads/' . $h->berkas)}}" target=”_blank”>File Berkas</a></td>
              <td class="status">{{$h->status}}</td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Chart Container -->
  <div class="chart-container mt-4 text-center">
    <canvas id="myChart"></canvas>
  </div>
</div>

<!-- Grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var PendaftarAkademik = parseInt(<?php echo $jumlahPendaftarAkademik ?>);
var PendaftarNonAkademik = parseInt(<?php echo $jumlahPendaftarNonAkademik ?>);

const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Beasiswa Akademik', 'Beasiswa Non-Akademik'],
    datasets: [{
      label: 'Jumlah Pendaftar Beasiswa',
      data: [PendaftarAkademik, PendaftarNonAkademik],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }

});
</script>
@endsection