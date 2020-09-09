<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SchoolInternal;
use Exception;
use Session;
class DashboardController extends Controller
{
	
	public function indexDashboard()
	{
		// $email = DB::table('users')->where('name', 'John')->value('email');
		$id = Session::get('school_internal')->id;
		$school_internal = SchoolInternal::where("id",$id)->first();
		
		$school_internal_image_path ="storage/schoolInternalImage/".$school_internal->profile_picture;

		// dd($school_internal_image_path);
		return view('internal/internal-dashboard',['school_internal_image' => $school_internal_image_path]);
		
	}


	

	public function updateProfile(Request $request)
	{

		$request->validate([
			'profile_picture' => 'required |mimes:jpeg,png',
		],
		[
			'profile_picture.required' => 'File Harus Diisi!',
		]);

		$file = $request->profile_picture;
		$id = Session::get('school_internal')->id;
		$school_internal = SchoolInternal::find($id);


		
		$profile_picture_name = $name = $school_internal->id.'_profile_picture'.time().'.'.request()->profile_picture->getClientOriginalExtension();
			
		try{
		// $file->move(storage_path("schoolInternalImage/"), $profile_picture_name);

		$file->storeAs('schoolInternalImage',$profile_picture_name);
		} catch (Exception $e) {
			return back()->with('error','Terjadi Kesalahan Pada Sistem');
		}


		$school_internal->profile_picture=$profile_picture_name;
		$school_internal->save();

		Session::flash('message', 'Sukses upload foto!');

		return back()->with('success','Sukses Upload Foto');
        
	}

	

}
