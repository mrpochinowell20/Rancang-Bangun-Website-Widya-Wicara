@extends('admin.layouts.app', [
  'elementActive' => 'create'
])
@section('content')

            <div class="panel panel-default mt-5">
                <div class="panel-heading  text-center">
                <strong> CREATE FOTO</strong>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    
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
 
                </div>
            </div>
        </div>
@endsection