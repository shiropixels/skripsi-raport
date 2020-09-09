<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Raport;
use App\TblStudent;
use DB;
use App\Imports\RaportImport;
use App\Imports\Raport_headerImport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class RaportController extends Controller
{
  public function getRaport()
  {
  }

  public function indexGetRaport()
  {
    $raport = Raport::all();
    $raport = DB::table('student as tb')
      ->select('*')
      ->join('raports', 'student_id', '=', 'tb.id')
      ->get();

    return view('/', compact('raport'));
  }

  public function storeRaport(Request $request)
  {
    $raport = new RaportImport();
    $rapor_header = new Raport_headerImport();
    if ($raport === null) {
      $data = Excel::import($raport, $request->file('select_file'));

      return redirect('/')->with('success', 'Nilai Berhasil Masuk');
    } else if ($rapor_header != null) {

      $dataNilai = Excel::import($rapor_header, $request->file('select_file'));

      return redirect('/')->with('success', 'Nilai Berhasil Masuk');
    }
  }





  public function GetTahunAjaran(Request $request)
  {
    $currentDate = new DateTime("now");
    // dd(time());

    $currentYear = $currentDate->format('yy');

    $epoch1Juli = strtotime("1 July {$currentYear}"); //Epoch

    if (time() < $epoch1Juli) {
      $tahunKemarin = (int) $currentYear - 1;

      $tambah = $tahunKemarin . "/" . $currentYear;
      // dd($tambah);
      // echo "Genap";


    } else if (time() > $epoch1Juli) {
      // $tahunSekarang = $currentDate = new DateTime("now");
      $tahunDepan = (int)$currentYear + 1;

      $tambahTahunIni = $currentYear . "/" . $tahunDepan;
      // echo "Ganjil";


    }

    // die();


    // dd($currentEpoch);
    // $strtotime = new DateTime('now');
    // if(date('Juli')< year('now'))
    // {
    //   $tanggal => new DateTime('now');
    //   dd($tanggal);
    // }

  }

  // public function editRaport($id)
  // {
  //   $raport = Raport::find($id);
  //   return view('',[''=> $raport]);
  // }

  // public function updateRaport($id,Request $request)
  // {
  //   $this->validate($request,[
  //    'student_id' => 'required',
  //    'created_at' => 'required',
  //    'update_at' => 'required'
  //  ]);

  //   $raport = Raport::find($id);
  //   $raport->student_id = $request->student_id;
  //   $raport->created_at = $request->created_at;
  //   $raport->update_at = $request->update_at;
  //   $raport->save();
  //   return redirect('');

  // }

  // public function deleteRaport($id)
  // {
  //   $raport = Raport::find($id);
  //   $raport->delete();
  //   return redirect('');
  // }






}
