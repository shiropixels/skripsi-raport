<?php

namespace App\Exports;

use App\Mata_pelajaran;
use App\Rapor_header;
use App\Raport;
use App\Exports\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class MataPelajaranExport implements FromQuery
{
    

    protected $id;

    function __construct($id)
    {
        $this->id = $id;
       //ini untuk menunjukan id student siapa yang mau kita export datanya
    }
   
  
    public function query()
    {
     
        $raport = DB::table('raports as r')
        ->select('r.student_id','r.id as rapor_id')
        ->where('r.student_id','=',$this->id)
        ->get()
        ->first();
         
        
      

        if($raport == null){
            return redirect('/internal/student-grade-list/'.$this->id);
        }

        $query = "SELECT rh.id as rapor_header_id,semester,grade,tahun_ajaran FROM rapor_headers rh
         WHERE rh.rapor_id =". $raport->rapor_id;
        
         $rapor_header = DB::select($query);
        //untuk membaca query semester,grade,tahun ajaran
         $raport_bundle_content = [];
         
        foreach ($rapor_header as $header) {
            $query = "SELECT nama_mata_pelajaran, nilai_uts, nilai_uas, catatan 
						FROM mata_pelajarans mp
							WHERE mp.rapor_header_id = " . $header->rapor_header_id;

            $datas = DB::select($query);
        //membaca setiap baris data yang ada di tabel web dan database
            $factory = new ShowRaporHeader(
                    $header->rapor_header_id,
                    $header->semester,
                    $header->grade,
                    $header->tahun_ajaran,
                    $datas
                );

            
                


            array_push($raport_bundle_content, $factory);
        }


        $rapot = new ShowRaport(
                $raport->student_id,
                $raport->rapor_id,
                $raport_bundle_content
            );

       

       
        return $rapot;
    }

   

}
class ShowRaport
{
    public $student_id;
    public $rapor_id;
    public $raport_headers;

    public function __construct($a, $b, $c)
    {
        $this->student_id = $a;
        $this->rapor_id = $b;
        $this->raport_headers = $c;
    }
}
class ShowRaporHeader
{
    public $rapor_header_id;
    public $semester;
    public $grade;
    public $tahun_ajaran;
    public $mata_pelajarans;

    public function __construct($a, $b, $c, $d, $e)
    {
        $this->rapor_header_id = $a;
        $this->semester = $b;
        $this->grade = $c;
        $this->tahun_ajaran = $d;
        $this->mata_pelajarans = $e;
    }
}