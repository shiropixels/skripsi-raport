<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\SchoolInternal;
use App\TblStudent;
use Session;
use DB;

class ForgotPasswordController extends Controller
{
	public function forgot($type){
		return view('forgot-password',['type' => $type]);
	}

	public function password(Request $request){
			if($request->isMethod('post')){
				$data = $request->all();
			//Get User Details
			$userDetails = SchoolInternal::where('email', $data['email']) -> first();

			//Generate Random Password
			 $random_password = Str::random(8);

			//Encode/Secure Password
			 $new_password = bcrypt($random_password);

			//Update Paasword
			SchoolInternal::where('email', $data['email']) -> update(['password' => $new_password]);

			//Send Forgot Password Email Code
			if(!isset($userDetails)){
				session::flash('error','Email yang anda masukkan salah.');
				return redirect('/forgot_password');
			}else{
			 $email = $data['email'];
			 $name = $userDetails->name;
			 $messageData = [
			 	'email' => $email,
			 	'name' => $name,
			 	'password' => $random_password
			 ];

			

			 Mail::send('email.forgotpassword', $messageData, function($message) use($email){
			 		$message->to($email) -> subject('New Password');
			 });		
			 	Session::flash('success', 'Silahkan cek email anda untuk melihat password baru !');
			 	return redirect('/auth/login-page');
			 	}
			}	
		}
	
	public function forgotStudent(){
		return view('forgot-password-student');
	}

	// public function passwordStudent(Request $request){
	// 	if($request->isMethod('post')){
	// 			$data = $request->all();
	// 		//Get User Details
	// 		$userDetails = TblStudent::where('email', $data['email']) -> first();

	// 		//Generate Random Password
	// 		 $random_password = Str::random(8);

	// 		//Encode/Secure Password
	// 		 $new_password = bcrypt($random_password);

	// 		//Update Paasword
	// 		TblStudent::where('email', $data['email']) -> update(['password' => $new_password]);

	// 		//Send Forgot Password Email Code
	// 		if(!isset($userDetails)){
	// 			session::flash('error','Email yang anda masukkan salah.');
	// 			return redirect('/forgot_password_student');
	// 		}else{
	// 		 $email = $data['email'];
	// 		 $nama = $userDetails->name;
	// 		 $messageData = [
	// 		 	'email' => $email,
	// 		 	'nama' => $nama,
	// 		 	'password' => $random_password
	// 		 ];
	// 		 Mail::send('email.forgotpasswordStudent', $messageData, function($message) use($email){
	// 		 		$message->to($email) -> subject('New Password');
	// 		 });		
	// 		 	Session::flash('success', 'Silahkan cek email anda untuk melihat password baru !');
	// 		 	return redirect('/student/LoginStudent');
	// 		 }
	// 	}
	// }
}

