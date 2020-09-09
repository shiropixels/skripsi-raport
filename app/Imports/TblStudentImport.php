<?php

namespace App\Imports;

use App\TblStudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use DB;
class TblStudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student = TblStudent::find($row[0]);
        
        if($row[0] === "id") return;
        


        if($student == null){
            $data = DB::table('student')
            ->select('*')
            ->where('nis','=',  trim($row[1]))
            ->get()
            ->first();

            //tujuan dari code diatas agar tidak terjadi duplikat data karena dia membaca sesuai nis


            //jika id di excel itu kosong maka dia akan mencreate data ke database


            if(isset($data->id)){
                return;
            }
            //isset check variable itu kosong atau tidak
  

            $email = DB::table('student')
            ->select('*')
            ->where('email','=', trim($row[4]))
            ->get()
            ->first();

            //sama kayak nis tujuanya adalah agar tidak terjadi duplikat data

            if(isset($email->id)){
                return;
            }

            
            return new TblStudent([
                'nis' => $row[1],
                'nama' => $row[2],
                'class_id' => (int) $row[3],
                'email' => $row[4],
                'phone' => $row[5],
                'password' => Hash::make($row[6]),
                'create_at' => new \DateTime('now')
            ]);
        }else if($student != null){
            $student->nis = $row[1];
            $student->name = $row[2];
            $student->class_id = (int) $row[3];
            $student->email = $row[4];
            $student->phone = $row[5];
            $student->password = Hash::make($row[6]);
            $student->update_at = new \DateTime('now');
            $student->save();
        }
       //Jika id di excel diisi makan fungsi diatas untuk mengupdate data tergantung id siapa aja yang dimaksukan bisa banyak


        return;
    }
}
