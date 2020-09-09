<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentClass;
use App\TblStudent;
use Illuminate\Support\Facades\DB;
class classController extends Controller
{

    



    public function IndexGetClass()
    {
        $class = StudentClass::all();
        return view('/internal/inputclass',compact('class'));
    }
   
    public function tambahclass()
    {
        return view('internal/inputclass');
    }

    public function storeclass(Request $request)
    {
    	$this->validate($request,[
            'class_name' =>'required',
            'peminatan' => 'required',
    		'grade' => 'required'

    	]);

    	StudentClass::create([
            'class_name' => $request->class_name,
            'peminatan' => $request->peminatan,
    		'grade' => $request->grade

    	]);

    	return redirect('');
    }

    public function deleteclass($id)
    {
    	$class = StudentClass::find($id);
    	$class->delete();
    	return redirect('');
    }



  
    



}
