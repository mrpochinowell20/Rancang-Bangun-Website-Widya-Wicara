@extends('admin.layouts.app', [
  'elementActive' => 'create'
])
@section('content')

            <div class="panel panel-default mt-5">
                <div class="panel-heading  text-center">
                <strong> CREATE GALERI</strong>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    
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
 
                </div>
            </div>
        </div>
@endsection