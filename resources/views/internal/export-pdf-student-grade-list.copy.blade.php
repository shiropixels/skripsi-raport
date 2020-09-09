<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body>

    <!-- data di bawah ini hardcode semua xd -->
    @foreach ($raport['raport_items'] as $items)
        <div class="container-fluid p-3 page-break">
            <div class="row mb-3">
                <div class="col-12">
                    <h2>Penilaian Akademik</h2>
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

                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Kelas:</span>
                    <span style="font-size:25px;">{{ $items->grade }} {{ $items->class_name }}
                        ({{ $items->major }})</span>
                </div>
                <!-- Tahun ajaran masih hardcode -->
                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Tahun Ajaran:</span>
                    <span style="font-size:25px;">{{ $items->start_year }}/{{ $items->end_year }}</span>
                </div>
                <!-- semester masih hardcode -->
                <div class="col-12">
                    <span class="text-bold mr-2" style="font-size:25px;">Semester:</span>
                    <span style="font-size:25px;">1</span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <table id="{{ $items->class_name }}" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Pengetahuan</th>
                                <th>Keterampilan</th>
                                <th>KKM</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loops = [1, 2, 3, 4, 5] as $loop)
                                <tr>
                                    <td>Nama Mata Pelajaran</td>
                                    <td>75</td>
                                    <td>88</td>
                                    <td>75</td>
                                    <td>Baik dalam mengikut mata pelajaran.</td>
                                </tr>
                            @endforeach
                            <tr class="text-bold">
                                <td>Total Nilai</td>
                                <td>75</td>
                                <td>88</td>
                                <td>75</td>
                                <td colspan="2"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
