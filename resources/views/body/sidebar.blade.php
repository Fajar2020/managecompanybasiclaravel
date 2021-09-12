@php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
  
@endphp
  
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('storage/logo_manage.png')}}" alt="ManageCompany" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ManageCompany</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{Auth::user()->profile_photo_url}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/user/profile" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ ($prefix == '/company')? 'active':'' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Companies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('add.company') }}" class="nav-link {{ ($route == 'add.company')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('all.company') }}" class="nav-link {{ ($route == 'all.company' || $route == 'company.edit')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reycle.all.company') }}" class="nav-link {{ ($route == 'reycle.all.company')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Recyclebin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ ($prefix == '/employee')? 'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('add.employee') }}" class="nav-link {{ ($route == 'add.employee')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('all.employee') }}" class="nav-link {{ ($route == 'all.employee' || $route == 'employee.edit')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reycle.all.employee') }}" class="nav-link {{ ($route == 'reycle.all.employee')? 'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In Recyclebin</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>