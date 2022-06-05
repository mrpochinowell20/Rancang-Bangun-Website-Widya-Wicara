@extends('admin.layouts.app', [
  'elementActive' => 'user'
])

@section('title', 'Edit | Data User');

@section('content')
<div class="col-12 col-md-4">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Edit User
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
          <form method="POST" action="{{route('user.update',$user->id)}}">
            {{ csrf_field() }}
            @method('PUT')

            <div class="form-group d-none">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" value="{{$user->username}}" required>
            </div>
            <div class="form-group">
              <label for="new_username">Username</label>
              <input type="text" class="form-control" id="new_username" name="new_username" placeholder="Masukan Nama" value="{{$user->username}}" required>
              <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" value="{{$user->name}}" required>
              <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group">
              <label for="">Admin Level</label>
              <select name="level" class="form-control" required>
                <option {{($user->level == "admin") ? 'selected' : ''}} value="admin">Admin</option>
                <option {{($user->level == "super_admin") ? 'selected' : ''}} value="super_admin">Super Admin</option>
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