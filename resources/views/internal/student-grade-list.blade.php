@extends('template.internal_master')
@section('title', 'Detail Nilai Siswa')

@section('content')
    <script>
        function convertGrade(val) {
            if (val >= 90) {
                document.write("A");
            } else if (val >= 80) {
                document.write("B");
            } else if (val >= 70) {
                document.write("C");
            } else if (val >= 60) {
                document.write("D");
            } else {
                document.write("F");
            }
        }

    </script>
    <div class="container-fluid p-3">
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

        <div class="row mb-3">
            <!-- nama masih hardcode -->
            <div class="col-12">
                <span class="text-bold mr-2" style="font-size:25px;">Nama:</span>
                <span style="font-size:25px;">{{ $raport['student']->name }}</span>
            </div>
            <!-- nomer telfon siswa masih hardcode -->
            <div class="col-12">
                <span class="text-bold mr-2" style="font-size:25px;">Nomor Telfon:</span>
                <span style="font-size:25px;">{{ $raport['student']->phone }}</span>
            </div>
        </div>

        <div class="row mb-3">
            {{-- <div class="col-2">
                <a href="" class="btn btn-primary">
                    <i class="ion ion-android-add mr-2"></i>
                    Tambah Nilai</a>
            </div> --}}
            <div class="col-2">
                <a href="{{ url('pelajaran/internal/export-student-grade-list/'.$raport['student']->id) }}" class="btn btn-danger">
                    <i class="ion ion-document mr-2"></i>
                    Export ke PDF</a>
            </div>
        </div>
        <!-- data di bawah ini hardcode semua xd -->
        @foreach ($raport['raport_items'] as $items)
            <div class="row mb-3">

                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Kelas:</span>
                    <span style="font-size:25px;">{{ $items->grade }} {{ $items->major }} {{ $items->class_name }}</span>
                </div>
                <!-- Tahun ajaran masih hardcode -->
                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Tahun Ajaran:</span>
                    <span style="font-size:25px;">{{ $items->start_year }}/{{ $items->end_year }}</span>
                </div>
                <!-- semester masih hardcode -->
                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Semester:</span>
                    <span style="font-size:25px;">{{ $items->semester }}</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <table id="{{ $items->class_name }}" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">Mata Pelajaran</th>
                                <th rowspan="2">KKM</th>
                                <th colspan="2">Pengetahuan</th>
                                <th colspan="2">Keterampilan</th>
                                <th rowspan="2">Catatan</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Angka</th>
                                <th>Predikat</th>
                                <th>Angka</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($items->detail) || count($items->detail) == 0)
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada Nilai</td>
                                </tr>
                            @else
                                @foreach ($items->detail as $d)
                                    @if(isset($d))
                                    <tr>
                                        <td>{{ $d->course_name }}</td>
                                        <td>{{ $d->min_grade }}</td>
                                        <td>{{ $d->score }}</td>
                                        <td>
                                            <script>
                                                convertGrade({!!$d->score!!})
                                            </script>
                                        </td>
                                        <td>{{ $d->practicume }}</td>
                                        <td>
                                            <script>
                                                convertGrade({!!$d->practicume!!})
                                            </script>
                                        </td>
                                        <td>{{ $d->description }}</td>
                                        <td>
                                        <button type="button" class="btn btn-primary" onclick="triggerModal('/ajax/get-score-edit-modal/{{ $d->id }}');">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>


@endsection
