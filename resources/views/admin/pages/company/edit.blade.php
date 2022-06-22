@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('title', 'Edit | Data company');

@section('content')
    <!-- Main content -->
    <div class="col-12 col-md-4">
        <section class="container-fluid">
          <div class="card card-default color-palette-box">
            <div class="card-header">
              <h3 class="card-title">
                Edit Data
              </h3>
            </div>
            <div class="card-body">
              <div class="col-12">
                <form method="POST" action="{{route('company.update',$company->id)}}"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input value="{{ $company->nama ?? old('nama') }}"
                      type="text" name='nama' class="form-control" id="name" placeholder="Masukkan Nama" >
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                          <textarea class="form-control" id="summernote" name="content" rows="10"></textarea>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
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
@section('javascript')
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- include summernote css/js-->
    <link href="summernote-bs5.css" rel="stylesheet">
    <script src="summernote-bs5.js"></script>
</head>
    <body>
        <div id="summernote"></div>
            <script>
                $('#summernote').summernote({
                placeholder: 'Hello Bootstrap 5',
                tabsize: 2,
                height: 100
                });
            </script>
    </body>
@endsection
