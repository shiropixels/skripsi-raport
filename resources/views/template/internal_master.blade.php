<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        E-Raport - @yield('title')
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('css_before')
    {{--
    <!-- font --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    {{--
    <!-- icon --> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{--
    <!-- main css --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/adminlte.min.css') }}">
    {{--
    <!-- iCheck --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/icheck-bootstrap.min.css') }}">

    {{-- FA --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/icon/fontawesome/all.min.css') }}">

    <!-- data table -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    {{--
    <!-- google font --> --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--
    <!-- overlay scrollbars --> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/OverlayScrollbars.min.css') }}">


    {{--
    <!-- jQuery --> --}}
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>

    {{-- FA --}}
    <script type="text/javascript" src="{{ asset('/icon/fontawesome/all.min.js') }}"></script>

    {{--
    <!-- jQuery UI 1.11.4 --> --}}
    <script type="text/javascript" src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    {{--
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip --> --}}
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    {{--
    <!-- Bootstrap 4 --> --}}
    <script type="text/javascript" src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    {{--
    <!-- overlayScrollbars --> --}}
    <script type="text/javascript" src="{{ asset('/js/jquery.overlayScrollbars.min.js') }}"></script>
    {{--
    <!-- AdminLTE App --> --}}
    <script type="text/javascript" src="{{ asset('/js/adminlte.js') }}"></script>
    {{--
    <!-- graph --> --}}


    {{--
    <!-- JSON --> --}}
    <script type="text/javascript" src="{{ asset('js/ajax-load.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-notify/bootstrap-notify.js') }}"></script>



    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>

    @yield('css_after')
    @yield('js_before')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="ion-android-menu"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-light bg-light elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('/image/logo global.png') }}" alt="sma-strada" class="brand-image img-square"
                    style="opacity: .8">
                <span class="brand-text font-weight-normal">GM School</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/image/sasuke.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info sidebar-light bg-light">
                        <a href="#" class="d-block text-dark">{{ Session::get('school_internal')->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/internal/internal-dashboard" class="nav-link bg-light">
                                <i class="nav-icon ion-android-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>

                        @if (Session::get('school_internal')->role_id == '1')
                            <li class="nav-item has-treeview">
                            <a href="{{url('internal/legalization')}}" class="nav-link bg-light">
                                    <i class="nav-icon ion-document"></i>
                                    <p>Manage Legalisir</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link bg-light">
                                    <i class="nav-icon ion-android-people"></i>
                                    <p>
                                        Manage Akun
                                        <i class="right ion-android-arrow-dropleft"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="/auth/internal/input-walikelas" class="nav-link bg-light">
                                            <p>Akun WaliKelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/student/internal/input-student" class="nav-link bg-light">
                                            <p>Akun Siswa</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link bg-light">
                                    <i class="nav-icon ion-locked"></i>
                                    <p>
                                        Lupa Password
                                        <i class="right ion-android-arrow-dropleft"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ url('forgot-password/school-internal') }}" class="nav-link bg-light">
                                            <p>Password Staff</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('forgot-password/student') }}" class="nav-link bg-light">
                                            <p>Password Siswa</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/class-management" class="nav-link bg-light">
                                    <i class="nav-icon ion-person-add"></i>
                                    <p>Manage Kelas</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/course-management" class="nav-link bg-light">
                                    <i class="nav-icon ion-ios-book"></i>
                                    <p>Manage Mata Pelajaran</p>
                                </a>
                            </li>
                        @endif
                        @if (Session::get('school_internal')->role_id == '2')
                            <li class="nav-item">
                                @if (Session::has('school_internal'))
                                    <a href="/pelajaran/internal/import-grade/{{ Session::get('school_internal')->id }}"
                                        class="nav-link bg-light">
                                        <i class="nav-icon ion-ios-people"></i>
                                        <p>List Siswa</p>
                                    </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('password/change-password') }}" class="nav-link bg-light">
                                <i class="nav-icon ion-android-unlock"></i>
                                <p>Ganti Password</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="/auth/logout" class="nav-link bg-light">
                                <i class="nav-icon ion-log-out"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    </section>
    </div>
    </div>
</section>
</div>
</div>

@yield('modal')


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

// @if(Session::has('error'))
//     <script type="text/javascript">
    
//     $.notify({message: '{{ Session::get('error') }}'},{ z_index: 99999, type: 'danger' });

//     </script>
// @endif

// @if(Session::has('success'))
//     <script type="text/javascript">
    
//     $.notify({message: '{{ Session::get('success') }}'},{ z_index: 99999, type: 'success' });

//     </script>
// @endif

<script type="text/javascript" src="{{ asset('js/custom/js-only-input-number.js') }}"></script>

</body>

</html>
