<?php

namespace App\Imports;

use App\Rapor_header;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
class Raport_headerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $rapor_header = Rapor_header::find($row[0]);

        if($row[0]=== "id") return;

        $rapor_header = DB::table('rapor_headers')
        ->select('*')
        ->where('rapor_id','=',trim([$row[1]))
        ->get()
        ->first();

        if(isset($rapor_header->id)){
            return;
        }
        if($rapor_header == null){
            return new Rapor_header([
                'rapor_id'=>(int) $row[1],
                'tahun_ajaran' => $row[2]
            
            ]);
        }else if($rapor_header != null)
        {
            $rapor_header->rapor_id = (int) $row[1];
            $rapor_header->tahun_ajaran = $row[2];
            $rapor_header->save();
        }

        return;
    }
}
