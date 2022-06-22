@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('title', 'Edit | Data solution');

@section('content')
    <!-- Main content -->
    <section class="content">
            <!-- left column -->
            <div class="col-12 col-md-4">
              <section class="container-fluid">
                <div class="card card-default color-palette-box">
                  <div class="card-header">
                    <h3 class="card-title">
                      Edit Solution
                    </h3>
                  </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('solution.update',$solution->id)}}"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input value="{{ $solution->nama ?? old('nama') }}"
                      type="text" name='nama' class="form-control" id="name" placeholder="Masukkan Nama " >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Subtitle</label>
                      <input value="{{ $solution->subtitle ?? old('subtitle') }}"
                      type="text" name='subtitle' class="form-control" id="name" placeholder="Masukkan Subtitle " >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descriptions</label>
                        <textarea  class="form-control" id="nama" name="deskriptions" rows="10" placeholder="Masukan Deskripsi" required>{{ $solution->deskriptions ?? old('deskriptions') }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Icon</label>
                        <img  id="image-preview-update" width="100px" src="/data_file/{{$solution->icon}}" alt="">
                        <input value="{{ $solution->icon ?? old('icon') }}"
                        type="file" name='icon' class="form-control" id="image-source-update" onchange="previewImageUpdate();"/>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
@endsection
@section('javascript')
             <script src="{{ asset('vendor/adminlte') }}/dist/js/pages/dashboard.js"></script>
             <script>
                 function previewImageUpdate() {
                   document.getElementById("image-preview-update").style.display = "block";
                   var oFReader = new FileReader();
                   oFReader.readAsDataURL(document.getElementById("image-source-update").files[0]);
                   oFReader.onload = function(oFREvent) {
                     document.getElementById("image-preview-update").src = oFREvent.target.result;
                   };
                 };
             </script>
@endsection