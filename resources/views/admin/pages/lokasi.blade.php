@extends('admin.layouts.app', [
  'elementActive' => 'lokasi'
])
@section("content")
<a href="{{ route('lokasi.create') }}" class="btn btn-primary mb-2">
                        Tambah Lokasi
                    </a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Desa</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Kabupaten</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($lokasi as $lokasi)

      <tr>
        <th scope="row"> {{$lokasi->id}}</th>
        <td>
            {{$lokasi->desa}}
        </td>
        <td>
            {{$lokasi->kecamatan}}
        </td>
        <td>
            {{$lokasi->kabupaten}}
        </td>
        <td>
        <a href="{{ route('lokasi.edit', $lokasi) }}" class="btn btn-primary btn-xs">
          Edit
            </a>
            <a href="{{ route('lokasi.destroy', $lokasi) }}"
                onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                Delete
            </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection