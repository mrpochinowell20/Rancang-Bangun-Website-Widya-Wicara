@extends('admin.layouts.app', [
  'elementActive' => 'mediasosial'
])

@section('title', 'Edit | Data Media Sosial');

@section('content')
<div class="col-12 col-md-4">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Edit
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          <form method="POST" action="{{route('mediasosial.update',$mediasosial->id)}} "enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name Aplication</label>
                    <input value="{{ $mediasoosial->name ?? old('name') }}"
                    type="text" name='name' class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Aplikasi">
                </div>
                <div class="form-group">
                    <label for="">Type</label>
                    <select name="tipe" class="form-control" required>
                      <option {{($mediasosial->tipe == "mediasosial") ? 'selected' : ''}} value="mediasosial">Social Media</option>
                      <option {{($mediasosial->tipe == "ecommerce") ? 'selected' : ''}} value="ecommerce">Ecommerce</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">URL</label>
                    <input value="{{ $mediasosial->url ?? old('url') }}"
                    type="text" name='url' class="form-control" id="exampleInputPassword1" placeholder="Masukkan URL">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Upload Icon</label>
                    {{-- <img id="image-preview-update" alt="image preview" width="200px"/> --}}
                    <img  id="image-preview-update" width="100px" src="/data_file/{{$mediasosial->icon}}" alt="">
                    <input value="{{ $mediasosial->upload ?? old('icon') }}"
                    type="file" name='icon' class="form-control" id="image-source-update" onchange="previewImageUpdate();"/>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
