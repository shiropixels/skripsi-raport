@extends('template.student_master')
@section('title', 'Dashboard')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('css/Chart.css') }}" />
@endsection
@section('content')
    <!-- <div class="content-header p-4">
        <div class="chart"></div>

    </div> -->

        <section class="content p-4">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Profil</h1>
                        </div>
                    </div>
                </div>
                @if(Session::get('message') != null)
                <div class="row">
                  <div class="col-12">
                    <div class="alert alert-success" role="alert">
                      <strong>
                        {{ Session::get('message') }}
                      </strong>
                    </div>
                  </div>
                </div>
          
                @elseif(Session::get('error') != null)
                <div class="row">
                  <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                      <strong>
                        {{ Session::get('error') }}
                      </strong>
                    </div>
                  </div>
                </div>
                @endif

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-sm-4">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <img id="profilePic" src="{{ url($student_image?? '') }}" alt="placeholder"
                                    class="rounded-circle" width="150" height="150"
                                    onerror="this.src='{{ asset('image/default.jpg') }}'">
                            </div>
                        </div>
                        <div class="row ml-1">
                            <form action="{{ url('/student/student-dashboard') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control-file" name="profile_picture" id="avatarFile"
                                        aria-describedby="fileHelp" accept="image/x-png,image/jpeg"
                                        onchange="document.getElementById('profilePic').src = window.URL.createObjectURL(this.files[0])">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size
                                        of image should
                                        not be more than 2MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </section>
                    <section class="col-sm-3">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-bold" style="font-size:30px;">NIS:</span>
                            </div>
                            <div class="col-12">
                                <span style="font-size:25px;">{{ Session::get('student')->code }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="text-bold" style="font-size:30px;">Nama:</span>
                            </div>
                            <div class="col-12">
                                <span style="font-size:25px;">{{ Session::get('student')->name }}</span>
                            </div>
                        </div>
                    </section>
                    <section class="col-sm-3">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-bold" style="font-size:30px;">Email:</span>
                            </div>
                            <div class="col-12">
                                <span style="font-size:25px;">{{ Session::get('student')->email }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="text-bold" style="font-size:30px;">Nomor Telfon:</span>
                            </div>
                            <div class="col-12">
                                <span style="font-size:25px;">{{ Session::get('student')->phone }}</span>
                            </div>
                        </div>


                    </section>

                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>

    @endsection
    @section('js_after')
    @endsection
