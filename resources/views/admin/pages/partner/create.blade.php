@extends('admin.layouts.app', [
  'elementActive' => 'create'
])
@section('content')

            {{-- <div class="panel panel-default mt-5">
                <div class="panel-heading  text-center">
                <strong>CREATE PARTNER</strong>
                </div>
                <div class="panel-body"> --}}
                    <div class="col-12 col-md-4">
                        <section class="container-fluid">
                          <div class="card card-default color-palette-box">
                            <div class="card-header">
                              <h3 class="card-title">
                                Create Partner
                              </h3>
                            </div>
                    <br/>
                    <br/>

                    <form method="post" action="{{route('partner.store')}}"enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <div class="form-group">
                        <label>Name</label>
                            <input type="text" name="nama" class="form-control" placeholder="Insert The Name">
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <input type="file" name="logo" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
        </div>
@endsection
