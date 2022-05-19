@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h1>
                Halo, Siska
            </h1>
          <div class="row">

            <!-- left column -->
            <div class="col-md-12 col-lg-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Ubah Lokasi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('lokasi.update',$lokasi->id)}}">
                    @csrf
                    @method('PUT')

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Desa</label>
                      <input value="{{ $lokasi->desa ?? old('desa') }}"
                      type="text" name='desa' class="form-control" id="exampleInputEmail1" placeholder="Masukkan Desa">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Kecamatan</label>
                      <input value="{{ $lokasi->kecamatan ?? old('kecamatan') }}"
                      type="text" name='kecamatan' class="form-control" id="exampleInputPassword1" placeholder="Masukkan Kecamatan">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kabupaten</label>
                        <input value="{{ $lokasi->kabupaten ?? old('kabupaten') }}"
                        type="text" name='kabupaten' class="form-control" id="exampleInputPassword1" placeholder="Masukkan Kabupaten">
                      </div>


                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>


          </div>
        </div>
    </section>
@endsection