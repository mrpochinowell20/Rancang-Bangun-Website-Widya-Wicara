@extends('admin.layouts.app', [
  'elementActive' => 'solution'
])

@section('title', 'Tambah | Data solution');

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
          <form method="POST" action="{{route('solution.store')}}"enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" required>
              <small class="text-danger">{{ $errors->first('nama') }}</small>
            </div>
            <div class="form-group">
              <label for="nama">Subtitle</label>
              <input type="text" class="form-control" id="name" name="subtitle" placeholder="Masukan Subtitle" required>
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group">
              <label for="nama">Deskriptions</label>
              <input type="text" class="form-control" id="nama" name="deskriptions" placeholder="Masukan Deskripsi" required>
              <small class="text-danger">{{ $errors->first('nama') }}</small>
            </div>
            <div class="form-group">
              <label for="nama">Icon</label>
              <input type="file" name='icon' class="form-control" id="nama" placeholder="Masukkan Foto">
            </div>
            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div> 
@endsection