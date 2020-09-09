<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MappingRapot implements WithHeadings
{
    function __construct($data)
    {
        $this->data = $data;

        //untuk membaca data di tabel ketika mau export ke excel
    }
    public function headings(): array
    {
            $columnIndex = 0;
            //index kosong
            $data = $this->data;
            $array = [];
			if (count($data->raport_headers) > 0) {
				foreach ($data->raport_headers as $d) {
                    array_push($array, ['class ' . $d->grade . ' Semester ' . $d->semester . ' Tahun Ajaran ' . $d->tahun_ajaran]);
                    array_push($array, ['No', 'Mata Pelajaran', 'UTS', 'UAS', 'Catatan']);
                    $idx = 1; 
					foreach($d->mata_pelajarans as $mp) {
                        array_push($array, [$idx, $mp->name_mata_pelajaran, $mp->nilai_uts, $mp->nilai_uas, $mp->catatan,]);
                        $idx += 1;
                    }
                    array_push($array, []);
				}
			}
        return $array;
       //count menghitung data yang ada di database
        //array push masukin element kedalam array
        //excel butuh data dari class yang menggunakan with header
        //heading itu overiding dari class with header yang digunakan untuk mengconvert multificonal array
        //multidimenstional array itu array isinya array lagi beranak 

    }
}