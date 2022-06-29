@extends('admin.layouts.app', [
  'elementActive' => 'create'
])

@section('title', 'Tambah | Data User');

@section('content')
<div class="col-12 col-md-4">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Tambah User
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          <form method="POST" action="{{route('user.store')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" required>
              <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" required>
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group">
              <label for="">Admin Level</label>
              <select name="level" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="super_admin">Super Admin</option>
              </select>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" pattern=".{0}|.{8,}" title="Minimal 8 karakter" required>
            </div>
            <button type="submit" class="btn btn-success mt-4">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
