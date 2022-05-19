@extends('admin.layouts.app', [
  'elementActive' => 'tambah'
])
@section('content')

            <div class="panel panel-default mt-5">
                <div class="panel-heading  text-center">
                <strong>TAMBAH LOKASI</strong>
                </div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    
                    <form method="post" action="{{route('lokasi.store')}}">
 
                        {{ csrf_field() }}
                        <div class="form-group">
                        <label>Desa</label>
                            <input type="text" name="desa" class="form-control" placeholder="Kenongomulyo">
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" placeholder="Takeran">
                        </div>

                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" placeholder="Madiun">
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                            <a href="/event" class="btn btn-primary">Kembali</a>
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
@endsection