@extends('admin.layouts.app', [
  'elementActive' => 'edit'
])

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">

            <!-- left column -->
            <div class="col-md-12 col-lg-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Change Partner</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('partner.update',$partner->id)}}"enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input value="{{ $partner->nama ?? old('nama') }}" type="text" name='nama' class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama" required>
                    </div>
                  <div class="form-group">
                        <label for="exampleInputPassword1">Icon</label>
                        <!-- <img id="image-preview-update" alt="image preview" width="200px"/> -->
                        <img id="image-preview-update" width="100px" src="/data_file/{{$partner->logo}}" alt="">
                        <input value="{{ $partner->logo ?? old('logo') }}" type="file" name='logo' class="form-control" id="image-source-update" placeholder=""onchange="previewImageUpdate();" />
                      </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
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
