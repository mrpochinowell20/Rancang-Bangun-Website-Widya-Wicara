@extends('admin.layouts.app', [
  'elementActive' => 'user'
])

@section('title', 'Data User');

@section('content')
<div>
  <div class = "row">
    <div class = "col-md-12">
      <h1>User<h1>
    </div>
    <div class="col-md-12">
      <div class="container-fluid bg-white p-4">
        <div class="mb-4">
          <a href="{{route('user.create')}}" class="btn btn-md btn-primary">Tambah data User</a>
        </div>
        <table class="table table-bordered data-table-user">
          <thead>
              <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
  $(document).ready(function () {
    var table = $('.data-table-user').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('user.index') }}",
        columns: [
          {data: 'username', name: 'username'},
          {data: 'name', name: 'name'},
          {data: 'level', name: 'level'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('.data-table-user').on('click', '#btn-delete', function (e) {
      deleteFunc($(this).data('id'))
    });

    function deleteFunc(id){
      Swal.fire({
        title: 'Apakah anda yakin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin, hapus!'

      }).then((result) => {
        if (result.isConfirmed) {
          $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          $.ajax({
            url: "/admin/mediasosial/"+id,
            method: 'DELETE',
            success: function(res){
              Swal.fire(
                'Dezssssxzleted!',
                'Data berhasil dihapus.',
                'success'
              )
              setTimeout(function(){
                $('.data-table-user').DataTable().ajax.reload();
              }, 1000);
            },
            error: function(err){
              Swal.fire(
                'Error!',
                'Data gagal dihapus.',
                'error'
              )
            }
          });
        }
      })
    }
  });
</script>
@endsection
