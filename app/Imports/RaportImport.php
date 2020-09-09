<?php

namespace App\Imports;

use App\RaportDetail;
use DB;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Session;

HeadingRowFormatter::
    default('none');

class RaportImport implements ToArray, WithHeadingRow, WithEvents
{

    public $sheetNames;

    public $inserted = 0;
    public $missing = 0;
    public function __construct()
    {
        $this->sheetNames = [];
    }
    public function array(array $array)
    {
        // echo(json_encode($array)."\n-----PEMISAH-------\n");
        // try {
        $currIdx = count($this->sheetNames) - 1;
        $id = Session::get('school_internal')->id;
        // \Log::debug($this->sheetNames[$currIdx]);
        // \Log::debug($array);
        //raport
        foreach ($array as $a) {
            if (is_null($a["Nama"])) {
                continue;
            }
            // dd($a);
            $raport = collect(DB::select("SELECT A.raport_id
                FROM m_student_class AS A
                INNER JOIN student AS B ON A.student_id = B.id
                INNER JOIN class AS C ON A.class_id = C.id
                INNER JOIN m_si_class D ON C.id = D.class_id
                WHERE D.school_internal_id = :id
                AND A.start_year = D.start_year
                AND A.end_year = D.end_year
                AND D.active = 'Y'
                AND A.active = 'Y'
                AND B.name LIKE :student_name
                AND B.active = 'Y'
            ", [
                'id' => $id,
                'student_name' => $a['Nama']
            ]))->first();

            //bugs code
            // $raport = DB::table('m_student_class AS A')
            //     ->select('A.raport_id','D.end_year')
            //     ->join('student AS B', 'A.student_id', 'B.id')
            //     ->join('class AS C','A.class_id','C.id')
            //     ->join('m_si_class AS D','C.id','D.class_id')
            //     ->where('D.school_internal_id','=',$id)  
            //     // ->where('A.start_year','=','D.start_year') //BUGS DISINI
            //     ->where('A.end_year','=','D.end_year')  //DAN DISINI (attribute nama sama di table beda)
            //     ->where('D.active','=','Y')
            //     ->where('A.active', 'Y')
            //     ->where('B.name', 'Like', $a["Nama"]) 
            //     ->where('B.active', '=', 'Y')               
            //     ->first();
            //matapelajaran
            $course = DB::table('course')
                ->select('*')
                ->where('name', 'Like', $this->sheetNames[$currIdx])
                ->first();
            \Log::debug("raport: " . json_encode($raport));
            \Log::debug("course: " . json_encode($course));
            if (isset($raport) && isset($course)) {


                $this->inserted += 1;
                $raportDetail = RaportDetail::where('raport_id', $raport->raport_id)
                    ->where('course_id', $course->id)
                    ->first();

                //belom ada raport detailnya
                if (!isset($raportDetail)) {
                    // \Log::debug('masuk sini '.json_encode($a));
                    RaportDetail::create([
                        'raport_id' => $raport->raport_id,
                        'course_id' => $course->id,
                        'score' => $a["Pengetahuan"],
                        'practicume' => $a["Keterampilan"],
                        'description' => $a["Catatan"],
                    ]);
                    //sudah ada raport detailnya
                } else {
                    $newRaportDetail = RaportDetail::where('raport_id', $raport->raport_id)
                        ->where('course_id', $course->id)
                        ->update([
                            'score' => $a["Pengetahuan"],
                            'practicume' => $a["Keterampilan"],
                            'description' => $a["Catatan"],
                        ]);
                }
            } else {
                // \Log::debug($this->sheetNames[$currIdx]);
                // \Log::debug($a);
                // \Log::debug("raport: " . json_encode($raport));
                // \Log::debug("course: " . json_encode($course));
                $this->missing += 1;
            }
        }
        // } catch (\Exception $e) {
        // }

    }
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $this->sheetNames[] = $event->getSheet()->getTitle();
            }
        ];
    }
    public function chunkSize(): int
    {
        return 100;
    }


    public function getSheetNames()
    {
        return $this->sheetNames;
    }
}
