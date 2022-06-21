@extends('admin.layouts.app', [
  'elementActive' => 'mediasosial'
])

@section('title', 'Edit | Data Media Sosial');

@section('content')
<section class="content">
    <div class="col-md-12 col-lg-6">
  <section class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Update Media</h3>
        </div>
          <form method="POST" action="{{route('mediasosial.update',$mediasosial->id)}} "enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input value="{{ $mediasosial->name ?? old('name') }}"
                    type="text" name='name' class="form-control" id="exampleInputPassword1" placeholder="Input Namer">
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
                    type="text" name='url' class="form-control" id="exampleInputPassword1" placeholder="Input URL">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Upload Icon</label>
                    {{-- <img id="image-preview-update" alt="image preview" width="200px"/> --}}
                    <img  id="image-preview-update" width="100px" src="/data_file/{{$mediasosial->icon}}" alt="">
                    <input value="{{ $mediasosial->upload ?? old('icon') }}"
                    type="file" name='icon' class="form-control" id="image-source-update" onchange="previewImageUpdate();"/>
                </div>
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
