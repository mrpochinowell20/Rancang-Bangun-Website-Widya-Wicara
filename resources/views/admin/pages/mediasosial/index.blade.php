@extends('admin.layouts.app', [
  'elementActive' => 'mediasosial'
])

@section('title', 'Data Media Sosial');

@section("content")
<div>
  <div class = "row">
    <div class = "col-md-12">
      <h1>Data Social Media<h1>
    </div>
    <div class="col-md-12">
      <div class="container-fluid bg-white p-4">
        <div class="mb-4">
          <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalTambahData">Create Data</button>
          <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahData" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('mediasosial.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name Aplication</label>
                            <input type="tel" name="name" class="form-control" placeholder="Masukan Nama Sosial Media">
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="tipe" class="form-control" required>
                              <option value="mediasosial">Social Media</option>
                              <option value="ecommerce">Ecommerce</option>
                            </select>
                          </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" name="url" class="form-control" placeholder="Masukan URL">
                        </div>

                        <div class="form-group">
                            <label>Upload Icon</label>
                            <input type="file" name="icon" class="form-control" placeholder="Masukan icon logo">
                        </div>
                    <button type="submit" class="btn btn-success mt-4">Submit</button>
                  </form>
            </div>
            </div>
            </div>
            </div>
</div>
        <table class="table table-bordered data-table-user">
          <thead>
              <tr>
                <th>No</th>
                <th>Name Aplication</th>
                <th>Type</th>
                <th>URL</th>
                <th>Icon</th>
                <th>Action</th>
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
        ajax: "{{ route('mediasosial.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'name', name: 'name'},
          {data: 'tipe', name: 'tipe'},
          {data: 'url', name: 'url'},
          {data: 'icon', name: 'icon'},
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
            url: "/admin/user/"+id,
            method: 'DELETE',
            success: function(res){
              Swal.fire(
                'Deleted!',
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
