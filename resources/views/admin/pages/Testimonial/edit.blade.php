@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('title', 'Edit | Data Testimoni');

@section('content')
    <!-- Main content -->
    <section class="content">
            <!-- left column -->
            <div class="col-md-12 col-lg-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Solution</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('testimonial.update',$testimonial->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                  <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Foto</label>
                        <img  id="image-preview-update" width="100px" src="/assets/img/{{$testimonial->image}}" alt="">
                        <input value="{{ $testimonial->image ?? old('image') }}"
                        type="file" name='image' class="form-control" id="image-source-update" onchange="previewImageUpdate();"/>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input value="{{ $testimonial->name ?? old('name') }}"
                      type="text" name='name' class="form-control" id="name" placeholder="Masukkan Nama " >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Pekerjaan</label>
                      <input value="{{ $testimonial->job ?? old('job') }}"
                      type="text" name='job' class="form-control" id="job" placeholder="Masukkan Pekerjaan " >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Testimoni</label>
                        <textarea name="testimonial" id="testimonial" class="form-control">{{ $testimonial->testimonial ?? old('testimonial') }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal</label>
                        <input value="{{ $testimonial->date ?? old('date') }}"
                        type="text" name='date' class="date form-control" id="date" placeholder="Masukkan Tanggal" >
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
             <script type="text/javascript">

              $('.date').datepicker({  
          
                 format: 'yyyy-mm-dd'
          
               });  
            </script> 
@endsection
