@extends('admin.layouts.app', [
  'elementActive' => 'feature'
])

@section('title', 'Data Feature');

@section("content")
<div>
  <div class = "row">
    <div class = "col-md-12">
      <h1>Data Feature<h1>
    </div>
    <div class="col-md-12">
      <div class="container-fluid bg-white p-4">
        <div class="mb-4">
          <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalTambahBarang">Create data Feature</button>
          <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{route('feature.store')}}"enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="nama">Name</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" required>
                <small class="text-danger">{{ $errors->first('nama') }}</small>
              </div>
              <div class="form-group">
                <label for="nama">Subtitle</label>
                <input type="text" class="form-control" id="name" name="subtitle" placeholder="Masukan Subtitle" required>
                <small class="text-danger">{{ $errors->first('name') }}</small>
              </div>
              <div class="form-group">
                <label for="nama">Descriptions</label>
                <textarea class="form-control" id="nama" name="deskriptions" rows="10" placeholder="Masukan Deskripsi" required></textarea>
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
            </div>
</div>
<div class="w-100">
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subtitle</th>
                    <th>Descriptions</th>
                    <th>Icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>
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
                ajax: "{{ route('feature.list') }}",
                columns: [
                {data: 'nama', name: 'nama'},
                {data: 'subtitle', name: 'subtitle'},
                {data: 'deskriptions', name: 'deskriptions'},
                {data: 'icon', name: 'icon', orderable:false},
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
      <script>
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            // if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            //     $("#delete-form").attr('action', $(el).attr('href'));
            //     $("#delete-form").submit();
            // }
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
    </div>
</div>
@endsection