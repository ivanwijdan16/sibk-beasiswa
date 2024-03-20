@extends('layouts.index')

@section('title', 'Daftar Beasiswa')

@section('content')

<style>
.content-about {
  width: 100%;
  max-width: 736px;
  height: auto;
  flex-shrink: 0;
  margin: 0 auto;
  overflow-x: auto;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  margin: 0;
}
</style>

<div class="container-lg mt-8">
  <div class="text-center">
    <h1 class="my-5 text-primary" style="font-weight: 800;">Daftar Beasiswa</h1>
    <img src="images/logo.png" alt="logo" height="100px">

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

  </div>
  <div class="content-about mt-5 ">
    <form action="{{url('daftar')}}" enctype="multipart/form-data" method="post">
      @csrf
      @if(Session::has('warning'))
      <div class="alert alert-warning mt-3" role="alert">
        {{ Session::get('warning') }}
      </div>
      @endif
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="form-group row mb-5">
              <label for="nama" class="col-sm-3 col-form-label fw-bold">Masukkan Nama</label>
              <div class="col-sm-9">
                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                  placeholder="Nama">
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="nomor_hp" class="col-sm-3 col-form-label fw-bold">Masukkan NIM </label>
              <div class="col-sm-9">
                <input type="number" class="form-control @error('nama') is-invalid @enderror" name="nim" id="nim"
                  placeholder="NIM">
                <span id="dt-s" class="mt-1 badge bg-danger d-none">NIM Tidak ditemukan</span>
                <span id="dt-t" class="mt-1 badge bg-success d-none">NIM Ditemukan</span>
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="email" class="col-sm-3 col-form-label fw-bold ">Masukkan Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                  placeholder="Email">
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="nomor_hp" class="col-sm-3 col-form-label fw-bold">Nomor HP</label>
              <div class="col-sm-9">
                <input type="number" class="form-control @error('nama') is-invalid @enderror" name="no_hp" id="nomor_hp"
                  placeholder="No. HP">
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="semester" class="col-sm-3 col-form-label fw-bold">Semester Saat Ini</label>
              <div class="col-sm-9">
                <select class="form-control" id="semester" required name="semester">
                  <option value="">Pilih Semester</option>
                  <option value="1">Semester 1</option>
                  <option value="2">Semester 2</option>
                  <option value="3">Semester 3</option>
                  <option value="4">Semester 4</option>
                  <option value="5">Semester 5</option>
                  <option value="6">Semester 6</option>
                  <option value="7">Semester 7</option>
                  <option value="8">Semester 8</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="ipk" class="col-sm-3 col-form-label fw-bold">IPK Terakhir</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('ipk') is-invalid @enderror bg-light" name="ipk" id="ipk"
                  readonly>
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="beasiswa" class="col-sm-3 col-form-label fw-bold">Pilihan Beasiswa</label>
              <div class="col-sm-9">
                <select class="form-control " id="beasiswa" name="beasiswa" required disabled>
                  <option value="">Pilih Jenis Beasiswa</option>
                  <option value="akademik">Beasiswa Akademik</option>
                  <option value="non_akademik">Beasiswa Non Akademik</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-5">
              <label for="berkas" class="col-sm-3 col-form-label fw-bold">Upload Berkas</label>
              <div class="col-sm-9">
                <input type="file" class="form-control-file @error('berkas') is-invalid @enderror" name="berkas"
                  id="berkas" disabled accept="image/*, application/pdf">
              </div>
            </div>
            <div class="form-group row mb-5">
              <div class="col-sm-6 text-center mt-3">
                <button id="submit-daftar" type="submit" class="btn btn-lg btn-primary btn-block fw-bold mx-auto px-10"
                  disabled>Daftar</button>
              </div>
              <div class="col-sm-6 text-center mt-3">
                <a type="button" class="btn btn-lg btn-danger btn-block fw-bold px-10" href="/">Batal</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

<!-- script untuk kondisi elemen bisa diklik atau tidak apabila ipk dibawah 3 atau diatas 3 -->
@push('script')
<script type="module">
$("#nim").on('keyup', async () => {
  cekipk($("#nim").val())
})


let cekipk = async (nim) => {
  $.ajax({
    url: "{{url('cekipk')}}" + `/${nim}`,
    method: 'GET',
    success: function(data) {
      console.log(data);
      $("#berkas").prop('disabled', true)
      $("#submit-daftar").prop('disabled', true)
      $("#beasiswa").prop('disabled', true)
      if (data.status) {
        $("#dt-s").addClass("d-none")
        $("#dt-t").removeClass("d-none")

        if (data.ipk > 3) {
          $("#berkas").prop('disabled', false)
          $("#submit-daftar").prop('disabled', false)
          $("#beasiswa").prop('disabled', false)
        }

      } else {
        $("#dt-s").removeClass("d-none")
        $("#dt-t").addClass("d-none")

      }

      $("#ipk").val(data.ipk)
    }
  })
}
</script>
@endpush