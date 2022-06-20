@extends('admin.layouts.app', [
  'elementActive' => 'company'
])

@section('title', 'Detail | Data Company');

@section('content')
<div>
    <div class = "row">
      <div class = "col-md-12">
        <h1>Detail Data<h1>
      </div>
      <div class="col-md-12">
        <div class="container-fluid bg-white p-4">
          <div class="mb-4">
            <table>
                <tr>
                    <th width="100px">Name</th>
                    <th width="30px">:</th>
                    <th>{{$company->kebutuhan}}</th>
                </tr>
                <tr>
                    <th width="50px">Content</th>
                    <th width="30px">:</th>
                    <th>{{$company->keterangan}}</th>
                </tr>
            </table>


@endsection
