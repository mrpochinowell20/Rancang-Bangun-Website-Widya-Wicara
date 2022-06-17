<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div class="brand-link py-3 bg-white d-flex justify-content-center align-items-center">
    <img src="{{ asset('assets/img/illustrations') }}/logo_widya.png" alt="Logo" class="brand-image mx-auto">
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/img/icons') }}/ic_user_default.svg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info mb-0">
        @if (auth()->user())
          <span class="d-block h5 text-white mb-0">{{auth()->user()->name}}</span>
        @endif
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('solutions')}}" class="nav-link {{ $elementActive == 'solution' ? 'active' : '' }}">
            <i class="nav-icon fas fa-shapes"></i>
            <p>
              Solutions
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('feature.index')}}" class="nav-link {{ $elementActive == 'feature' ? 'active' : '' }}">
            <i class="nav-icon fas fa-paw"></i>
            <p>
              Feature
            </p>
          </a>
        </li>
        @role('super_admin')
        {{-- User --}}
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link {{ $elementActive == 'user' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Data User
            </p>
          </a>
        </li>
        {{-- User --}}
        @endrole
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
