@extends('admin.layouts.app', [
  'elementActive' => 'partner'
])
@section("content")

<div class="row">
    <div class="col-md-12">
        <h1>Manajemen Partner</h1>
    </div>
    <div class="col-md-12">
        <div class="container-fluid bg-white p-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Create Partner</button>
        <div class="container-fluid bd-white p-4">
            <div class="mb-4">

                {{-- Modal Create--}}
                <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreate" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Create The Partner</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form method="post" action="{{route('partner.store')}}"enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
                                    </div>
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Simpan">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Modal Edit--}}
                <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Create The Partner</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" id="FormEdit" action="#" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nama</label>
                                      <input value=""
                                      type="text" name='nama' id="nama" class="form-control" placeholder="Masukkan Nama">
                                    </div>
                                  <div class="form-group">
                                        <label for="exampleInputPassword1">Logo</label>
                                        <img id="image-preview-update" width="100px" src="#" alt="">
                                        <input value=""
                                        type="file" name='logo' id="logo" class="form-control" placeholder=""onchange="previewImageUpdate();"/>
                                      </div>

                                  </div>
                                  <!-- /.card-body -->

                                  <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">Save Change</button>
                                  </div>
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
                            <th>No</th>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <form action="" id="delete-form" method="post">
                @method('delete')
                @csrf
            </form>
        </div>
        </div>
    </div>
</div>

    @section('javascript')

    <script>
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('partner.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'logo', name: 'logo'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ]
        });
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
@endsection
