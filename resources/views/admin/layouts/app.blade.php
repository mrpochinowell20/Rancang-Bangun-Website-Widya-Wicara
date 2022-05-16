@include('admin.layouts.partials.header')
@include('admin.layouts.partials.navbar')
@include('admin.layouts.partials.sidebar')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content p-3">
    <!-- Default box -->
    @yield('content')
  </section>
  <!-- /.content -->
</div>

@include('admin.layouts.partials.footer')
@include('admin.layouts.partials.javascript')