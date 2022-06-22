@extends('admin.layouts.app', [
  'elementActive' => 'create'
])
@section('content')
<div class="col-12 col-md-10">
  <section class="container-fluid">
    <div class="card card-default color-palette-box">
      <div class="card-header">
        <h3 class="card-title">
          Create New Article
        </h3>
      </div>
      <div class="card-body">
        <div class="col-12">
        <form method="post" action="{{route('article.store')}}"enctype="multipart/form-data">
 
            {{ csrf_field() }}

    <div class="form-group">
      <label>Title</label>
      <input type="text" id="title" name="title" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label>Slug</label>
      <input type="text" id="slug" name="slug" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label for="category">Category <code></code></label>
      <select class="custom-select form-control-border" id="category" name="category">
      <option>Acara</option>
      <option>Fitur</option>
      <option>Informasi</option>
      <option>Promo</option>
      </select>
    </div>

    <div class="form-group">
      <label>Content</label>
        <textarea class="form-control" id="summernote" name="content" rows="3" placeholder="Enter ..."></textarea>
    </div>

    <div class="form-group">
      <input type="submit" name="status" class="btn btn-md btn-primary" value="Publish">
      <input type="submit" name="status" class="btn btn-success" value="Save as Draft">
    </div>
 
    </form>   
@endsection

@section('javascript')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <script>
      $(document).ready(function() {
        $('#summernote').summernote();

        $('#title').on('input', function(e) {
          const title = $(this).val();
          const slug = title.split(' ').join('-').toLowerCase();

          $('#slug').val(slug);
        });
      })
  </script>   
@endsection