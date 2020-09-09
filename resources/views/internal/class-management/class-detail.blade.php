@extends('template.internal_master')
@section('title', 'Manage Kelas')

@section('css_before')
<style>
  .floatingActionButton{
      position: fixed;
      bottom: 10%;
      right: 5%;
      z-index: 9998;
      width: 50px;
      height: 50px;
      padding: 7px 10px;
      border-radius: 100%;
  }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('/curryan/select2/css/select2.min.css') }}" />
@endsection

@section('content')
<div class="container-fluid">
    <button id="fab" class="btn btn-danger d-none floatingActionButton">
      <i class="fa fa-times"></i>
    </button>

    <div class="row ml-2 mb-3">
        <div class="col-4">
            <span class="text-bold" style="font-size:30px;">
              {{ $class->name }}
            </span>
        </div>
    </div>

    <div class="row ml-2 mb-3">
        <div class="col-12 col-md-2 col-lg-1">
          <button type="button" @if(count($s_internals) == 2) disabled @endif class="btn btn-primary" data-toggle="modal" data-target="#tambah_Walikelas">
            Tambah Walikelas
          </button>
        </div>

        <div class="col-12 col-md-2 col-lg-1 mt-2 mt-md-0">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_Siswa">
            Tambah Siswa
          </button>
        </div>

        <div class="col-12 col-md-2 col-lg-1 mt-2 mt-md-0">
          <button type="button" class="btn btn-primary" onclick="triggerModal('/ajax/get-class-course-mapping/{{ $class->id }}');">
            Daftar Mata Pelajaran
          </button>
        </div>
        <div class="col-12 col-md-2 col-lg-1 mt-2 mt-md-0">
          <form action="/class-management/change-semester/{{$class->id}}" method="post">
            @csrf

            @if($change_semester)
              <!-- Mass Genocide Button || Tombol Nuklir -->

              <button @if(!empty($students[1])) type="submit" @endif id="change-to-second-term-btn" @empty($students[1]) title="Tidak ada murid di kelas ini." @endempty class="btn btn-primary @if(empty($students[1])) disabled @endif">
                Ubah Ke Semester 2
              </button>
            
            @endif
          </form>
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

    <div class="row ml-2 mr-2">
        <div class="col-12">
            <h3 class="text-bold">Walikelas</h3>
            
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Nama Walikelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($s_internals as $set)
                    <tr>
                        <td>{{ $set->name }}</td>
                        <td width="10%">
                        <button type="button" class="btn btn-danger" onclick="triggerModal('/ajax/get-class-deactivate-school-internal/{{ $set->school_internal_id }}');">
                              Nonaktifkan
                          </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

    <div class="row ml-2 mr-2">
        <div class="col-12">
            <h3 class="text-bold">Siswa</h3>
            
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $set)
                    <tr>
                        <td>{{ $set->name }}</td>
                        <td width="10%">
                            <button type="button" class="btn btn-danger"  onclick="triggerModal('/ajax/get-class-deactivate-student/{{ $set->student_id }}');">
                                Nonaktifkan
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('modal')
  @include('internal/class-management/functions-class-detail/add-new-student')
  @include('internal/class-management/functions-class-detail/add-new-walikelas')
@endsection

@section('js_after')
  <script src=" {{ asset('/curryan/select2/js/select2.full.min.js') }} "></script>
  <script type="text/javascript">
     $('.js-select2 ').select2();
  </script>
@endsection