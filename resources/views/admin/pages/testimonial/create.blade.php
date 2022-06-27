@extends('admin.layouts.app', [
  'elementActive' => 'testimonial'
])

@section('title', 'Tambah | Data testimoni');

@section('content')
<div class="col-12 col-md-4">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Tambah solution
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          <form method="POST" action="{{route('testimonial.store')}}"enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nama">Foto</label>
                <input type="file" name='image' class="form-control" id="nama" placeholder="Masukkan Foto" required>
              </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="name" placeholder="Masukan Nama" required>
              <small class="text-danger">{{ $errors->first('nama') }}</small>
            </div>
            <div class="form-group">
              <label for="nama">Pekerjaan</label>
              <input type="text" class="form-control" id="name" name="job" placeholder="Masukan Pekerjaan" required>
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group">
              <label for="nama">Testimoni</label>
              <input type="text" class="form-control" id="nama" name="testimonial" placeholder="Masukan Testimoni" required>
              <small class="text-danger">{{ $errors->first('nama') }}</small>
            </div>
            <div class="form-group">
                <label for="nama">Tanggal</label>
                <input type="text" class="form-control" id="nama" name="date" placeholder="Masukan Testimoni" required>
                <small class="text-danger">{{ $errors->first('nama') }}</small>
              </div>

            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
