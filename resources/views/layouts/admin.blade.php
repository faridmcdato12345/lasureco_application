<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>LASURECO</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <style>
    @media print{
    @page {
    size: landscape;
    }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div id="app" class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" style="color:#D50000"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{asset('images/logo.gif')}}" alt="LASURECO Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">LASURECO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">Username:&nbsp;&nbsp;{{Auth::user()->username}}</a>
          <a href="#" class="d-block">Account Type:&nbsp;&nbsp;{{Auth::user()->role->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item application">
            <a href="{{route('application.index')}}" class="nav-link">
              <i class="nav-icon fa fa-users" style="color:#ffffff;"></i>
              <p>
                Applicants
              </p>
            </a>
            @include('partials.notification')
          </li>
          <li class="nav-item inspection">
            <a href="{{route('inspection.index')}}" class="nav-link">
              <i class="nav-icon fa fa-search" style="color:#ffff0a;"></i>
              <p>
                Inspection
              </p>
            </a>
          </li>
          <li class="nav-item paid">
            <a href="{{route('paid.index')}}" class="nav-link">
              <i class="nav-icon fa fa-money" style="color:#76FF03;"></i>
              <p>
                Paid
              </p>
            </a>
          </li>
          @if (Auth::user()->role_id == 1)
          <li class="nav-item user">
          <a href="{{route('user.index')}}" class="nav-link">
              <i class="nav-icon fa fa-user" style="color:#795548;"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item has-treeview setting">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog" style="color:#7C4DFF"></i>
              <p>
                Setting
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('profile.index')}}" class="nav-link password">
                  <i class="nav-icon"></i>
                  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item form-group">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-sign-out" style="color:#D50000"></i>
                <p>
                Sign-out
                </p>
            </a>
          </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
           
        </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        @yield('modal')
    </div>
    <div class="modal fade" id="importModal" aria-hidden="true">
      @yield('importModal')
    </div>
    @yield('check')
    @yield('addMaterial')
    @yield('change-password')
  </div>
  
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="#">LASURECO</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function() {
        $(".succes-alert").css('display','none')
    }, 3000);
    let pathName = window.location.pathname;
    let num_one = getSecondPart(pathName,1)
    let num_two = getSecondPart(pathName,2)
    if(num_two == undefined){
      if($('.nav-item').hasClass(num_one)){
        $('.nav-item.'+num_one+' > a').addClass('active')
      }
    }
    else{
      if($('.nav-item.'+num_one).hasClass(num_one)){
        $('.nav-item.'+num_one).addClass('menu-open')
        $('.nav-item.'+num_one+' > a').addClass('active')
        $('.nav-item.'+num_two+' > a').addClass('active')
      }
    }
    function getSecondPart(str, num = '') {
      return str.split('/')[num];
    }
  })
</script>
@yield('script')
</html>
