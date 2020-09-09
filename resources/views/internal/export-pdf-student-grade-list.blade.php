<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Penilaian Akademik</title>

    <style>
        .raport-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000;
        }

        .raport-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            margin-bottom: 3px;
        }

        .raport-box table td {
            padding: 5px;
            vertical-align: top;
            font-size: 12px;
        }

        /* .raport-box table tr td:nth-child(2) {
            text-align: right;
        } */

        .raport-box table tr.top table td {
            padding-bottom: 20px;
        }

        .raport-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .raport-box table tr.information table td {
            padding-bottom: 40px;
        }

        .raport-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #fff;
            font-weight: bold;
        }

        .raport-box table tr.details td {
            padding-bottom: 20px;
        }

        .raport-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .raport-box table tr.item.last td {
            border-bottom: none;
        }

        .raport-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .raport-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .raport-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body>
    @foreach ($raport['raport_items'] as $items)
        <div class="raport-box page-break">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ public_path('/image/logo global.png') }}" width="200">
                                </td>

                                <td style="text-align: right">
                                    Tanggal Dibuat: {{ $items->create_at }}<br>
                                    Revisi Terakhir: {{ $items->update_at }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Nama Peserta Didik<br>
                                    Nomor Induk<br>
                                    Kelas<br>
                                    Semester<br>
                                    Tahun Ajaran
                                </td>
                                <td>
                                    :<br>:<br>:<br>:<br>:
                                </td>
                                <td>
                                    {{ $raport['student']->name }}<br>
                                    {{ $raport['student']->code }}<br>
                                    {{ $items->grade }} {{ $items->major }} {{ $items->class_name }}<br>
                                    {{ $items->semester }}<br>
                                    {{ $items->start_year }}/{{ $items->end_year }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table style="width:100%">
                <tr class="heading">
                    <td rowspan="2">Mata Pelajaran</td>
                    <td rowspan="2">KKM</td>
                    <td colspan="2">Pengetahuan</td>
                    <td colspan="2">Keterampilan</td>
                    <td rowspan="2">Catatan</td>
                </tr>
                <tr class="heading">
                    <td>Angka</td>
                    <td>Predikat</td>
                    <td>Angka</td>
                    <td>Predikat</td>
                </tr>
                @foreach ($items->detail as $d)
                    <tr>
                        <td>{{ $d->course_name }}</td>
                        <td>{{ $d->min_grade }}</td>
                        <td>{{ $d->score }}</td>
                        <td>{{ $d->score_grade }}</td>
                        <td>{{ $d->practicume }}</td>
                        <td>{{ $d->practicume_grade }}</td>
                        <td>{{ $d->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <tr class="heading" style="text-align: center">
                    <td colspan="2">
                        Kehadiran
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Absent
                    </td>

                    <td>
                        {{ $items->absent }} Hari
                    </td>
                </tr>
            </table>

            <table>
                <tr class="heading" style="text-align: center">
                    <td colspan="2">
                        Catatan Wali Kelas
                    </td>
                </tr>

                <tr class="item">
                    <td colspan="2" style="height: 100px; border: 1px solid">
                    </td>
                </tr>
            </table>
            <br>
            <table style="width: 100%">
                <tr style="text-align: right;">
                    <td>Bogor, {{ $items->update_at }}</td>
                </tr>
                <tr style="text-align: right;">
                    <td>Kepala Sekolah</td>
                </tr>
                <tr>
                    <td style="text-align: right">
                        <img src="{{public_path($raport['stample'])}}" height="150" style="position: absolute; z-index: -1;right: 0; opacity: 0.8;">
                        <img src="{{public_path($raport['signature'])}}" height="100">
                    </td>
                </tr>
                <tr style="text-align: right;font-weight:bold;">
                    <td>( {{$raport['headmaster']}} )</td>
                </tr>
            </table>
        </div>
    @endforeach
</body>

</html>
