<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rapor_header;
use Db;
class rapor_headersController extends Controller
{
    public function getRaporHeader()
    {
    	$raport_headers = Rapor_header::all();
    	$raport_headers = DB::table('raports as rs')
    	->select('*')
    	->join('raport_headers','rapor_id','=','rs.id')
    	->get();

    	return view('/',compact($raport_headers));
    }

    public function storeRaport(Request $request)
  	{

  	}

  	public function editRaportHeader($id)
  	{
  		$raport_headers::find($id);
  		return view('',[''=>$raport_headers]);
  	}

  	public function updateRaportHeader($id)
  	{
  		$this->validate($request,[
  			'rapor_id' => 'required',
  			'tahun_ajaran' => 'required'
  		]);

  		$raport_headers = Rapor_header::find($id);
  		$raport_headers->rapor_id = $request->rapor_id;
  		$raport_headers->tahun_ajaran = $request->tahun_ajaran;
  		$raport_headers->save();
  		return redirect('');

  	}

  	public function deleteRaportHeader($id)
  	{
  		$raport_headers = Rapor_header::find($id);
  		$raport_headers->delete();
  		return redirect('');
  	}
}
