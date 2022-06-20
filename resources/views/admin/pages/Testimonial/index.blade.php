@extends('admin.layouts.app', [
  'elementActive' => 'testimonial'
])

@section('title', 'Data Testimonial');

@section("content")

<div class="row">
  <div class="col-md-12">
    <h1>Testimonial</h1>
  </div>
  <div class="col-md-12">
    <div class="container-fluid bg-white p-4">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahTestimoni">Create Testimonial</button>
    <div class="container-fluid bf-white p-4">

      <div class="mb-4">

        {{-- Modal Create --}}
        <div class="modal fade" id="modalTambahTestimoni" tabindex="-1" aria-labelledby="modalTambahTestimoni" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('testimonial.store')}}"enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="nama">Image</label>
                    <input type="file" name='image' class="form-control" id="image" placeholder="Masukkan Foto">
                  </div>
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" required>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Job</label>
                    <input type="text" class="form-control" id="job" name="job" placeholder="Masukan Pekerjaan" required>
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Testimonial</label>
                    <textarea name="testimonial" id="testimonial" class="form-control" cols="30" rows="10"></textarea>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Date</label>
                    <input type="date" class="date form-control" id="date" name="date" placeholder="Masukan Tanggal" required>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <button type="submit" class="btn btn-success mt-4">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="modalEditTestimoni" tabindex="-1" aria-labelledby="modalEditTestimoni" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{route('testimonial.store')}}"enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="nama">Image</label>
                    <input type="file" name='image' class="form-control" id="image" placeholder="Masukkan Foto">
                  </div>
                  <div class="form-group">
                    <label for="nama">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" required>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Job</label>
                    <input type="text" class="form-control" id="job" name="job" placeholder="Masukan Pekerjaan" required>
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Testimonial</label>
                    <textarea name="testimonial" id="testimonial" class="form-control" cols="30" rows="10"></textarea>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <div class="form-group">
                    <label for="nama">Date</label>
                    <input type="hidden" class="date form-control" id="date" name="date" placeholder="Masukan Tanggal" required>
                    <small class="text-danger">{{ $errors->first('nama') }}</small>
                  </div>
                  <button type="submit" class="btn btn-success mt-4">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="w-100">

        <table class="table table-bordered yajra-datatable">
          <thead>
              <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Job</th>
                  <th>Testimonial</th>
                  <th>Date</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
           <tr>
            <td></td>
           </tr>
          </tbody>
      </table>
      </div>

    </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')

      <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
      </form>

     <script>
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('testimonial.list') }}",
                columns: [
                {data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                        return "<img src=\"/assets/img/" + data + "\" height=\"50\"/>";
                    },
                orderable:true},
                {data: 'name', name: 'name'},
                {data: 'job', name: 'job'},
                {data: 'testimonial', name: 'testimonial'},
                {data: 'date', name: 'date'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true,
                }
                ]
            });
        });
    </script>

    <script type="text/javascript">

      $('.date').datepicker({

         format: 'yyyy-mm-dd'

       });
    </script>

      <script>
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delete-form").attr('action', $(el).attr('href'));
                    $("#delete-form").submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        }
      </script>
    @endsection
