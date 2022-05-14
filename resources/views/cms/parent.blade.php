<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resturant | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{auth()->user()->unReadNotifications()->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{auth()->user()->notifications()->count()}} Notifications</span>
          <div class="dropdown-divider"></div>
          @foreach (auth()->user()->notifications as $notification)

          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>  {{$notification->data['title']}}
            <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
{{-- 
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div> --}}
          <a href="{{route('notifications.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('cms/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @canany(['Create-Admin','Create-vendor','Create-User','Read-vendors','Read-Users','Read-Admins'])

            <ul class="nav nav-treeview">

              <li class="nav-header">{{__('cms.hr')}}</li>
              @canany(['Create-Admin', 'Read-Admins'])

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.admins')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Admins')
                  <li class="nav-item">
                    <a href="{{route('admins.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                  @endcan
                  @can('Create-Admin')
                  <li class="nav-item">
                    <a href="{{route('admins.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  @endcan      
                </ul>
              </li>
             @endcanany

              @canany(['Create-User', 'Read-Users'])

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.users')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-Users')

                  <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>

                    </a>
                  </li>

                  @endcan

                  @can('Create-User')
                  <li class="nav-item">
                    <a href="{{route('users.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  @endcan

                </ul>

              </li>  
              @endcanany

              @canany(['Create-vendor', 'Read-vendors'])

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.vendors')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  @can('Read-vendors')
                  <li class="nav-item">
                    <a href="{{route('vendors.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                  @endcan
                  @can('Create-vendor')
                  <li class="nav-item">
                    <a href="{{route('vendors.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  @endcan

                 
                </ul>
              </li>
              @endcanany


            </ul>
             @endcanany


            @canany(['Create-Category','Create-Product','Create-City','Create-SupCategory','Read-SupCategories','Read-Categories','Read-Products','Read-Cities'])

            <li class="nav-header">{{__('cms.content_management')}}</li>
             @canany(['Create-Category', 'Read-Categories'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  {{__('cms.categories')}}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                @can('Read-Categories')

                <li class="nav-item">
                  <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.index')}}</p>
                  </a>
                </li>
                @endcan
                @can('Create-Category')
                <li class="nav-item">
                  <a href="{{route('categories.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.create')}}</p>
                  </a>
                </li>
                @endcan
                
              </ul>
            </li>
            @endcanany
            @canany(['Create-SupCategory','Read-SupCategories'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  {{__('cms.supcategory')}}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                @can('Read-SupCategories')                  

                <li class="nav-item">
                  <a href="{{route('sup_categories.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.index')}}</p>
                  </a>
                </li>
                @endcan
                @can('Create-SupCategory')

                <li class="nav-item">
                  <a href="{{route('sup_categories.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.create')}}</p>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcanany
            @canany(['Create-Product','Read-Products'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  {{__('cms.products')}}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                @can('Read-Products')                  

                <li class="nav-item">
                  <a href="{{route('products.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.index')}}</p>
                  </a>
                </li>
                @endcan
                @can('Create-Product')
               
                <li class="nav-item">
                  <a href="{{route('products.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.create')}}</p>
                  </a>
                </li>
                @endcan

                
              </ul>
            </li>
            @endcanany
            @canany(['Create-City','Read-Cities'])

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  {{__('cms.cities')}}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                @can('Read-Cities')
                <li class="nav-item">
                  <a href="{{route('cities.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.index')}}</p>
                  </a>
                </li>
                @endcan
                @can('Create-City')
                <li class="nav-item">
                  <a href="{{route('cities.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('cms.create')}}</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>

            @endcanany
            @endcanany

            <li class="nav-header">{{__('cms.settings')}}</li>
            <li class="nav-item">
              <a href="{{route('password.edit')}}" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">{{__('cms.edit_password')}}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('cms.logout')}}" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">{{__('cms.logout')}}</p>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page_lg')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@yield('main_page_md')</a></li>
              <li class="breadcrumb-item active">@yield('page_sm')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
@yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  {{-- <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div> --}}
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
@yield('scripts')
</body>
</html>
