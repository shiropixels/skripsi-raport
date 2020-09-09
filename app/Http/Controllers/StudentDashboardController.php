<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Session;
use Exception;

class StudentDashboardController extends Controller
{
    public function IndexDashboard()
	{
		$id = Session::get('student')->id;
		$student = Student::where("id",$id)->first();
		
		$student_image_path ="storage/studentImage/".$student->profile_picture;

		return view('student/student-dashboard',['student_image' => $student_image_path]);
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
		$id = Session::get('student')->id;
		$student = Student::find($id);


		
		$profile_picture_name = $name = $student->id.'_profile_picture'.time().'.'.request()->profile_picture->getClientOriginalExtension();
			
		try{

		$file->storeAs('studentImage',$profile_picture_name);
		} catch (Exception $e) {
			return back()->with('error','Terjadi Kesalahan Pada Sistem');
		}


		$student->profile_picture=$profile_picture_name;
		$student->save();

		return back()->with('success','Sukses Upload Foto');
        
	}
}
