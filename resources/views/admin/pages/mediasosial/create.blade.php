@extends('admin.layouts.app', [
  'elementActive' => 'mediasosial'
])

@section('title', 'Tambah | Data Media Sosial');

@section('content')
<div class="col-12 col-md-4">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Create
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          <form method="POST" action="{{route('mediasosial.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Nama Aplikasi</label>
                    <input type="tel" name="name" class="form-control" placeholder="Masukan Nama Sosial Media">
                </div>
                <div class="form-group">
                    <label for="">Tipe</label>
                    <select name="tipe" class="form-control" required>
                      <option value="mediasosial">Media Sosial</option>
                      <option value="ecommerce">Ecommerce</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label>Url</label>
                    <input type="text" name="url" class="form-control" placeholder="Masukan URL">
                </div>

                <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="icon" class="form-control" placeholder="Masukan icon logo">
                </div>
            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
