<?php

namespace App\Http\Controllers;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\SchoolInternal;
use Session;
use Exception;
use Mail;

class ChangePasswordController extends Controller
{
	public function editChangePassword()
	{
		return view('/change-password');
	}

	public function updatePasswordStudent(Request $request)
	{
		if (strlen($request->get('new-password')) < 8) {
			Session::flash('error', 'Password harus terdiri lebih dari 8 karakter!');
			return redirect()->back();
		}

		$student = Session::get('student');
		//Session pas login

		$student_password = Student::find($student->id);
		//cari objeck  student berdasarkan id

		$student_password->password = Hash::make($request->get('new-password'));
		$student_password->save();

		Session::flash('success', 'Password anda berubah');
		return redirect('/password/change-password');
	}

	public function updatePasswordSchoolInternal(Request $request)
	{
		try {
			$newPassword = $request->get('new-password');
			$confirmPassword = $request->get('conf-password');
			if (strlen($newPassword < 8)) {
				return back()->with('error', 'Password Harus Lebih dari 8 Karakter');
			} else if ($newPassword != $confirmPassword) {
				return back()->with('error', 'Password Tidak Sama Dengan Konfirmasi Password');
			}

			$id = Session::get('school_internal')->id;

			$school_internal = SchoolInternal::find($id);

			$school_internal->password = Hash::make($newPassword);
			$school_internal->update_at = new \Datetime('now');
			$school_internal->save();

			Session::flash('success', 'Password anda berubah');
			return redirect('/password/change-password');
		} catch (Exception $ex) {
			return back()->with('error', 'Terjadi Kesalahan Pada Sistem');
		}
	}
	public function sendPasswordEmail($type, Request $request)
	{
		\Log::debug($request->all());
		$faker = Faker::create('id_ID');
		try {
			$password = $faker->numberBetween(10000000, 99999999);
			$data = null;
			if ($type == 'school-internal') {
				$school_internal = SchoolInternal::where('email', 'LIKE', $request->email)
					->update([
						'password' => bcrypt($password)
					]);
				$data = SchoolInternal::where('email', '=', $request->email)->first();
			} else if ($type == 'student') {
				$student = Student::where('email', 'LIKE', $request->email)
					->update([
						'password' => bcrypt($password)
					]);
				$data = Student::where('email', '=', $request->email)->first();
			}
			if(!isset($data)) {
				return back()->with('error', 'Data tidak ditemukan berdasarkan email yang diberikan.');
			}
			Mail::send('email/forgot-password', ['nama' => $data->name, 'password' => $password], function ($message) use ($request) {
				$message->subject('Reset Password Sekolah Global Mandiri (no-reply)');
				$message->from('dummyskripsisatu@gmail.com', 'dummy1');
				$message->to($request->email);
			});
			return back()->with('success', 'Berhasil Kirim Email');
		} catch (Exception $e) {
			// return response(['status' => false, 'errors' => $e->getMessage()]);
			\Log::debug($e->getMessage());
			return back()->with('error', 'Terjadi Kesalahan Pada Sistem');
		}
	}
}
