<?php

namespace App\Imports;

use App\Mata_pelajaran;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
use Session;
class MataPelajaranImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] === "nama_mata_pelajaran") return;

        if(Session::get('new_raport_header') != null){
          return new Mata_pelajaran([
            'rapor_header_id' => Session::get('raport_header_id'),
            'nama_mata_pelajaran' => $row[0],
            'nilai_uts' => (float) $row[1],
            'nilai_uas' => (float) $row[2],
            'catatan' => $row[3]
          ]);
        }

        $mata_pelajaran = Mata_pelajaran::where('nama_mata_pelajaran', '=', trim($row[0]))
                          ->where('rapor_header_id', '=', Session::get('raport_header_id'))
                          ->get()->first();
                          

        if($mata_pelajaran ==null){

            return new Mata_pelajaran([
                'rapor_header_id' => Session::get('raport_header_id'),
                'nama_mata_pelajaran'=>$row[0],
                'nilai_uts'=>(double)$row[1],
                'nilai_uas'=>(double)$row[2],
                'catatan'=>$row[3]
            ]);
        }else if($mata_pelajaran !=null)
        {
          $mata_pelajaran->name_mata_pelajaran=$row[0];
          $mata_pelajaran->nilai_uts=(double) $row[1];
          $mata_pelajaran->nilai_uas=(double) $row[2];
          $mata_pelajaran->catatan= $row[3];

          $mata_pelajaran->save(); 
        }

      return;
      //functionya tidak mereturn apapun karena return void
  }
}
