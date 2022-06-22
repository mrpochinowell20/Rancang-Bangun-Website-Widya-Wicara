@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('content')
    <!-- Main content -->
    <section class="content">
    
              <div class="col-12 col-md-4">
                <section class="container-fluid">
              <div class="card card-default color-palette-box">
              <div class="card-header">
                  <h3 class="card-title">
                    Edit 
                  </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('galeri.update',$galeri->id)}}"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        <!-- <img id="image-preview-update" alt="image preview" width="200px"/> -->
                        <img id="image-preview-update" width="100px" src="/data_file/{{$galeri->image}}" alt="">
                        <input value="{{ $galeri->image ?? old('image') }}"
                        type="file" name='image' class="form-control" id="image-source-update" placeholder=""onchange="previewImageUpdate();"/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input value="{{ $galeri->description ?? old('description') }}"
                      type="text" name='description' class="form-control" id="exampleInputEmail1" placeholder="Description">
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success mt-4">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>


          </div>
        </div>
    </section>
@endsection
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