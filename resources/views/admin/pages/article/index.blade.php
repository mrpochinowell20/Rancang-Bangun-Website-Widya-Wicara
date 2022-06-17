@extends('admin.layouts.app', [
  'elementActive' => 'article'
])
@section('content')
<div>
    <div class = "row">
      <div class = "col-md-12">
        <h1>LIST ARTICLE<h1>
      </div>
      <div class="col-md-12">
        <div class="container-fluid bg-white p-4">
          <div class="mb-4">
            <div class="container-small">
                <div class="row">
                    <a href="{{ route('article.create') }}" class="btn btn-success">
                        Create New Article
                    </a>

                    <div class="w-100">
                        <div class="panel panel-default">
                            <div id="Tabs" role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a href="#publish" class="active nav-link" aria-controls="publish" role="tab" data-toggle="tab">
                                        Publish </a></li>
                                    <li class="nav-item"><a href="#draft" class="nav-link" aria-controls="draft" role="tab" data-toggle="tab">Draft</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" style="padding-top: 20px">
                                    <div role="tabpanel" class="tab-pane active" id="publish">
                                        <table class="table table-bordered yajra-datatable-publish">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Slug</th>
                                                    <th>Category</th>
                                                    <th>Content</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="draft">
                                        <table class="table table-bordered yajra-datatable-draft w-100">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Slug</th>
                                                    <th>Category</th>
                                                    <th>Content</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="" id="delete-form" method="post">
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
</div>

</div>

@endsection

@section('javascript')
    <script>
    $(document).ready(function() {

        var table = $('.yajra-datatable-publish').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('article.list.publish') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'no', name: 'no'},
            {data: 'title', name: 'title'},
            {data: 'slug', name: 'slug'},
            {data: 'category', name: 'category'},
            {data: 'content', name: 'content'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
            ]
        });

        var table2 = $('.yajra-datatable-draft').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('article.list.draft') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'no', name: 'no'},
            {data: 'title', name: 'title'},
            {data: 'slug', name: 'slug'},
            {data: 'category', name: 'category'},
            {data: 'content', name: 'content'},
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