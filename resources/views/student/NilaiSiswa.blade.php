@extends('template.student_master')
@section('title', 'Penilaian Akademik')
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
    <section class="content">
    
        <div class="container-fluid p-4">
            <div class="contetn-header">
                <div class="row mb-3">
                    <div class="col-12">
                        <h1 class="m-0 text-dark">Penilaian Akademik</h1>
                    </div>
                </div>
            </div>
            
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
                <div class="col-2">
                    <a href="{{ url('pelajaran/internal/export-student-grade-list/' . $raport['student']->id) }}"
                        class="btn btn-danger">
                        <i class="ion ion-document mr-2"></i>
                        Export ke PDF</a>
                </div>
            </div>
            <!-- data di bawah ini hardcode semua xd -->
            @foreach ($raport['raport_items'] as $items)
                <div class="row mb-3 ml-1">
                    <div class="col md-6">
                        <div class="row">
                            <span class="text-bold mr-2" style="font-size:25px;">Kelas:</span>
                            <span style="font-size:25px;">{{ $items->grade }} {{ $items->major }}
                                {{ $items->class_name }}</span>
                        </div>
                        <div class="row">
                            <span class="text-bold mr-2" style="font-size:25px;">Tahun Ajaran:</span>
                            <span style="font-size:25px;">{{ $items->start_year }}/{{ $items->end_year }}</span>
                        </div>
                        <div class="row">
                            <span class="text-bold mr-2" style="font-size:25px;">Semester:</span>
                            <span style="font-size:25px;">{{ $items->semester }}</span>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div class="row">
                            <div class=" col md-6 text-bold" style="font-size:25px;">Walikelas:</div>
                            <div class=" col md-6" style="font-size:25px;">
                                @php $flag = 0; @endphp

                                @foreach ($raport['school_internal'] as $si)
                                    @if($items->class_id == $si->class_id)
                                        @php $flag++; @endphp

                                        <div class="row">
                                            {{ $flag }}. {{ $si->name }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col md-6 text-bold" style="font-size:25px;">Nomor Telepon:</div>
                            <div class=" col md-6" style="font-size:25px;">
                                @php $flag = 0; @endphp

                                @foreach ($raport['school_internal'] as $si)
                                    @if($items->class_id == $si->class_id)
                                        @php $flag++; @endphp

                                        <div class="row">
                                            {{ $flag }}. {{ $si->phone }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <table id="{{ $items->class_name }}" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">Mata Pelajaran</th>
                                    <th rowspan="2" class="align-middle">KKM</th>
                                    <th colspan="2" class="text-center">Pengetahuan</th>
                                    <th colspan="2" class="text-center">Keterampilan</th>
                                    <th rowspan="2" class="align-middle">Catatan</th>
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
                                        <tr>
                                            <td class="align-middle">{{ $d->course_name }}</td>
                                            <td class="align-middle text-center">{{ $d->min_grade }}</td>
                                            <td class="align-middle text-center">{{ $d->score }}</td>
                                            <td class="align-middle text-center">
                                                <script>
                                                    convertGrade({!!$d->score!!})

                                                </script>
                                            </td class="align-middle text-center">
                                            <td class="align-middle text-center">{{ $d->practicume }}</td>
                                            <td class="align-middle text-center">
                                                <script>
                                                    convertGrade({!!$d->practicume!!})

                                                </script>
                                            </td>
                                            <td>{{ $d->description }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal" id="modalNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputEdit" class="col-sm-3 col-form-label">Edit:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEdit" placeholder="Nama Mata Pelajaran"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPengetahuan" class="col-sm-3 col-form-label">Pengetahuan:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inputPengetahuan" min="0" max="100"
                                        placeholder="Nilai Mata Pelajaran">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputKeterampilan" class="col-sm-3 col-form-label">Keterampilan:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="inputKeterampilan" min="0" max="100"
                                        placeholder="Nilai Mata Pelajaran">
                                </div>
                                <!-- <div class="invalid-feedback">Isi nilai dari 0 sampai 100</div> -->
                            </div>
                            <div class="form-group row">
                                <label for="inputCatatan" class="col-sm-3 col-form-label">Catatan:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control responsive" id="inputCatatan"
                                        placeholder="Isi Catatan">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
