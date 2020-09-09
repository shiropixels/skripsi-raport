<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>
    E-Raport - @yield('title')
  </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  @yield('css_before')
  {{-- <!-- font --> --}}
  <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
  {{-- <!-- icon --> --}}
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  {{-- <!-- main css --> --}}
  <link rel="stylesheet" type="text/css" href="{{asset('/css/adminlte.min.css')}}">
  {{-- <!-- iCheck --> --}}
  <link rel="stylesheet" type="text/css" href="{{asset('/css/icheck-bootstrap.min.css')}}">

  
  {{-- FA --}}
  <link rel="stylesheet" type="text/css" href="{{asset('/icon/fontawesome/all.min.css')}}">
  
  {{-- <!-- google font --> --}}
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- <!-- overlay scrollbars --> --}}
  <link rel="stylesheet" type="text/css" href="{{asset('/css/OverlayScrollbars.min.css')}}">

  
  {{-- <!-- jQuery --> --}}
  <script type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>

  
  {{-- FA --}}
  <script type="text/javascript" src="{{asset('/icon/fontawesome/all.min.js')}}"></script>

  {{-- <!-- jQuery UI 1.11.4 --> --}}
  <script type="text/javascript" src="{{asset('/js/jquery-ui.min.js')}}"></script>
  {{-- <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --> --}}
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  {{-- <!-- Bootstrap 4 --> --}}
  <script type="text/javascript" src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
  {{-- <!-- overlayScrollbars --> --}}
  <script type="text/javascript" src="{{asset('/js/jquery.overlayScrollbars.min.js')}}"></script>
  {{-- <!-- AdminLTE App --> --}}
  <script type="text/javascript" src="{{asset('/js/adminlte.js')}}"></script>
  {{-- <!-- graph --> --}}

    <script type="text/javascript" src="{{ asset('js/bootstrap-notify/bootstrap-notify.js') }}"></script>

  @yield('css_after')
  @yield('js_before')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  
  <div class="wrapper">
      <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="ion-android-menu"></i></a>
        </li>
      </ul>  
    </nav>
     <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light bg-light elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{asset('/image/logo global.png')}}" alt="Global Mandiri School" class="brand-image img-square"
        style="opacity: .8">
        <span class="brand-text font-weight-normal">GM School</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('/image/sasuke.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info sidebar-light bg-light">
            <a href="#" class="d-block text-dark">{{Session::get('student')->name}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/student/student-dashboard" class="nav-link bg-light">
                <i class="nav-icon ion-android-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            @if(Session::has('student'))
              <li class="nav-item">
              <a href="/student/siswa/NilaiSiswa/{{ Session::get('student')->id}}" class="nav-link bg-light">
                  <i class="nav-icon ion-android-clipboard"></i>
                  <p>
                    Penilaian Akademik
                  </p>
                </a>
              </li>
            @endif
            <li class="nav-item">
              <a href="/password/change-password" class="nav-link bg-light">
                <i class="nav-icon ion-unlocked"></i>
                <p>
                  Ganti Password
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/student/StudentLogout" class="nav-link bg-light">
                <i class="nav-icon ion-log-out"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>

<span id="modal-place"></span>

<script type="text/javascript"> 
  let modalPlace = $('#modal-place'); 
  
  function triggerModal(url){
    $.ajax({
      "method": "GET", 
      "dataType": 'html', 
      "url": url,
      "success": function(e){
          modalPlace.empty();
          modalPlace.append(e);
      },
      "error": function(xhr, status, error){
        alert("An error occured: "+ xhr);
      }
    });
  }
</script>

@yield('js_after')


@if(Session::has('error'))
    <script type="text/javascript">
    
    $.notify({message: '{{ Session::get('error') }}'},{ z_index: 99999, type: 'danger' });

    </script>
@endif

@if(Session::has('success'))
    <script type="text/javascript">
    
    $.notify({message: '{{ Session::get('success') }}'},{ z_index: 99999, type: 'success' });

    </script>
@endif
</body>
</html>