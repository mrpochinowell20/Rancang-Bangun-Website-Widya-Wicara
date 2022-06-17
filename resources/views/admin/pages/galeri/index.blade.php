@extends('admin.layouts.app', [
  'elementActive' => 'galeri'
])
@section("content")
@section('content')
<div>
    <div class = "row">
      <div class = "col-md-12">
        <h1>Data Galeri<h1>
      </div>
      <div class="col-md-12">
        <div class="container-fluid bg-white p-4">
          <div class="mb-4">
            <table>
<div class="container-small">
  <div class="row">
  <button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalTambahBarang">Create Galeri</button>
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
<!--FORM TAMBAH BARANG-->
<!-- <form action="" method=" ">
<div class="form-group">
<label for="">Foto</label>
<input type="text" class="form-control" id="addNamaBarang" name="addNamaBarang" aria-describedby="emailHelp">
</div>
<div class="form-group">
<label for="">Jumlah Barang</label>
<input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
</div>
<button type="submit" class="btn btn-primary">Simpan Data</button>
</form> -->
<form method="post" action="{{route('galeri.store')}}"enctype="multipart/form-data">
 
  {{ csrf_field() }}

  <div class="form-group">
      <label>Foto</label>
      <input type="file" name="foto" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <input type="submit" class="btn btn-success" value="Simpan">
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
                    <th>Foto</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="row">
  <button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalTambahBarang">Edit</button>
  <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Galeri</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!--FORM TAMBAH BARANG-->
<!-- <form action="" method=" ">
<div class="form-group">
<label for="">Foto</label>
<input type="text" class="form-control" id="addNamaBarang" name="addNamaBarang" aria-describedby="emailHelp">
</div>
<div class="form-group">
<label for="">Jumlah Barang</label>
<input type="text" class="form-control" id="addJumlahBarang" name="addJumlahBarang">
</div>
<button type="submit" class="btn btn-primary">Simpan Data</button>
</form> -->
<form method="post" action="{{route('galeri.store')}}"enctype="multipart/form-data">
 
  {{ csrf_field() }}

  <div class="form-group">
      <label>Foto</label>
      <input type="file" name="foto" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control" placeholder="">
  </div>

  <div class="form-group">
      <input type="submit" class="btn btn-success" value="Simpan">
  </div>
 
</form>
<!--END FORM TAMBAH BARANG-->
</div>
</div>
</div>
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
                {data: 'foto', name: 'foto'},
                {data: 'keterangan', name: 'keterangan'},
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