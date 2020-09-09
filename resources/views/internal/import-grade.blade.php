@extends('template.internal_master')
@section('title', 'Nilai Akademik')

@section('content')
    <div class="container-fluid p-4">
        <div class="row mb-3">
            <div class="col-12">
                <h2>Penilaian Akademik</h2>
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


        @if (empty($class))
            <div class="row bg-secondary">
                <div class="col-12 p-2 text-center">
                    <h5>Tidak ada kelas yang aktif</h5>
                </div>
            </div>
        @else
            <div class="row mb-3">
                <div class="col-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">
                        Import
                    </button>
                </div>
                <div class="col-2">
                <form action="{{url('pelajaran/internal/how-to-upload')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Panduan Upload <span class="ion ion-android-document"></span></button>
                    </form>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <h3>Kelas {{ $class->grade }} {{ $class->major }} {{ $class->class_name }}</h3>
                </div>
                <div class="col-12">
                    <h3>Tahun Ajaran {{ $class->start_year }}/{{ $class->end_year }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="siswa" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor Induk Siswa</th>
                                <th>Nomor Telfon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($students) || count($students) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada siswa</td>
                                </tr>
                            @else
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->code }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>
                                            <form
                                                action="{{ url('pelajaran/internal/student-grade-list/' . $student->id) }}"
                                                method="get">
                                                <button type="submit" class="btn btn-info text-white">Detail Nilai</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="modal" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenteredLabel">Import Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('pelajaran/internal/upload-grade/12') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                                <input type="file" id="customFile" name="student_grade" class="form-control-file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <!-- <div class="custom-file">
                                <label class="form-control-label" for="customFile">Choose
                                    file</label>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#siswa').DataTable();
            });

        </script>
    @endsection
