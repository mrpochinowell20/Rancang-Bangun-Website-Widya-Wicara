@extends('admin.layouts.app', [
  'elementActive' => 'galeri'
])
@section("content")
@section('content')
<div>
    <div class = "row">
      <div class = "col-md-12">
        <h1>Galeri<h1>
      </div>
      <div class="col-md-12">
        <div class="container-fluid bg-white p-4">
          <div class="mb-4">
            <table>
<div class="container-small">
  <div class="row">
  <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalTambahBarang">Create Galeri</button>
  <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Create Galeri</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post" action="{{route('galeri.store')}}"enctype="multipart/form-data">
 
  {{ csrf_field() }}

  <div class="form-group">
      <label>Image</label>
      <input type="file" name="image" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <label>Description</label>
      <input type="text" name="description" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <input type="submit" class="btn btn-success" value="Submit">
  </div>
 
</form>
<!--END FORM TAMBAH BARANG-->
</div>
</div>
</div>
</div>

    <div class="w-100">
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>

    @section('javascript')
    <script>
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('galeri.list') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'no', name: 'no'},
                {data: 'image', name: 'image'},
                {data: 'description', name: 'description'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
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
                title: 'Are you sure delete it?',
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