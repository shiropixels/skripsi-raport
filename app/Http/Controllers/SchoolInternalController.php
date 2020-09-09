<?php

namespace App\Http\Controllers;

use App\Constant;
use Illuminate\Http\Request;
use App\SchoolInternal;
use App\Role;
use App\MSiClass;
use Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Imports\SchoolInternalImport;
use Maatwebsite\Excel\Facades\Excel;

use App\StudentClass;

use Log;

class SchoolInternalController extends Controller
{
	public function IndexLogin()
	{
		return view('Login');
	}
	public function LoginSchool(Request $request)
	{
		// dd($request->all());
		$validate = Validator::make($request->all(), [
			"email" => 'required',
			"password" => 'required'

		]);


		if ($validate->fails()) {
			$error = $validate->errors()->first();

			Session::flash('error', $error);
			return redirect('auth/login-page');
		}

		$data = DB::table('school_internal AS A')
			->join('role AS B', 'A.role_id', '=', 'B.id')
			->select('A.*', 'B.name as role_name')
			->where('A.active', '=', 'Y')
			->where('A.email', '=', $request->get('email'))
			->get()->first();

		if (!isset($data)) {
			Session::flash('error', 'Autentikasi error! Cek kembali username dan kata sandi anda');
			return redirect('auth/login-page');
		}

		//Jika email yang kita masukin ama email di database beda maka akan return error seperti di atas

		if (!Hash::check($request->get('password'), $data->password)) {
			Session::flash('error', 'Kata sandi salah ! Cek kembali kata sandi anda!');
			return redirect('auth/login-page');
		}

		//Jika password yang kita masukin ama password di database tidak sama maka akan return error seperti contoh code di atas

		Session::put('school_internal', $data);
		Session::put('class', StudentClass::all());
		//ini itu untuk ngebaca session class untuk menu sidebar penilaian akademik dari model
		return redirect('internal/internal-dashboard');
	}



	public function LogoutSchool()
	{

		Session::flush();
		return redirect('/auth/login-page');
	}

	public function DataSiswa($class)
	{
		$tbl_student = TblStudent::all();
		$tbl_student = DB::table('class AS k')
			->select('*')
			->join('student', 'class_id', '=', 'k.id')
			->where('class_id', '=', $class)
			->get();
		//ini untuk ngeshow nama siswa berdasarkan class yang dia sekarang
		return view('/internal/DaftarSiswaPerclass', compact('tbl_student'));
	}
	public function IndexWaliKelas()
	{
		$school_internal = DB::table('school_internal AS A')
			->select('A.*')
			->join('role AS B', 'A.role_id', 'B.id')
			->where('B.name', '=', 'WaliKelas')
			->get();

		$role = DB::table("role")
			->where('role.name', '=', 'WaliKelas')
			->select('role.id', 'role.name')
			->first();

		return view('/internal/input-walikelas')
			->with('role', $role)
			->with('school_internal', $school_internal);
	}

	public function storeWaliKelas(Request $request)
	{
		$guru = new SchoolInternalImport();
		//mengambil data yang ada di school internal import di foldel imports
		$data = Excel::import($guru, $request->file('select_file'));
		//ini untuk membaca file excel ketika mau import data ke database
		return redirect('/auth/internal/input-walikelas')->with('success', 'Data Siswa Telah Masuk');
	}

	public function TambahWaliKelas()
	{
		return view('/internal/TambahDataWaliKelas');
	}

	public function StoreTambahWaliKelas(Request $request)
	{
		try {
			$role = Role::where('name', '=', 'WaliKelas')->first();

			for ($i = 0; $i < count($request->get('name')); $i++) {
				$school_interal = SchoolInternal::create([
					"name" => $request->get('name')[$i],
					"email" => $request->get('email')[$i],
					"password" => Hash::make($request->get('password')[$i]),
					"phone" => $request->get('phone')[$i],
					"role_id" => $role->id,
					"profile_picture" => "",
					'create_at' => new \DateTime('now'),
					'update_at' => new \DateTime('now'),
					'active' => 'Y'
				]);

				Log::debug('Created School Internal: ' . $school_interal);
			}

			Session::flash('message', 'Data Berhasil Ditambahkan!');
			return redirect('/auth/internal/input-walikelas');
		} catch (\Throwable $e) {
			Log::error('Add Wali class Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/auth/internal/input-walikelas');
		}
	}

	public function editWaliKelas($id)
	{
		$walikelas = DB::table('school_internal AS A')
			->select('A.*', 'C.name AS class_name')
			->leftJoin('m_si_class AS B', 'A.id', 'B.school_internal_id')
			->leftJoin('class AS C', 'B.class_id', 'C.id')
			->where('A.id', '=', $id)
			->first();

		return view('/internal/EditDataWaliKelas', compact('walikelas'));
	}



	public function updateWaliKelas($id, Request $request)
	{
		try {
			$student_class = StudentClass::where('name', 'LIKE', $request->class_name)->first();
			if (empty($student_class) || !isset($student_class)) {
				Session::flash('error', 'Kelas Tidak Ditemukan');
				return redirect('/auth/internal/input-walikelas');
			}
			$walikelas = DB::table('school_internal AS A')
				->join('m_si_class AS B', 'A.id', 'B.school_internal_id')
				->join('class AS C', 'B.class_id', 'C.id')
				->where('A.id', '=', $id)
				->update([
					'A.name' => $request->name,
					'A.email' => $request->email,
					'A.phone' => $request->phone,
					'B.class_id' => $student_class->id,
					'A.update_at' => new \Datetime('now'),
					'B.update_at' => new \Datetime('now'),
				]);

			Session::flash('message', 'Data Berhasil Disunting!');
			return redirect('/auth/internal/input-walikelas');
		} catch (\Throwable $e) {
			Log::error('Edit Wali class Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/auth/internal/input-walikelas');
		}
	}



	public function deleteWaliKelas($id)
	{
		$school_internal = SchoolInternal::find($id);

		try {
			$school_internal->delete();
			Session::flash('message', 'Data Berhasil Dihapus!');
			return redirect('/auth/internal/input-walikelas');
		} catch (\Throwable $e) {
			Log::error('Delete Wali class Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/auth/internal/input-walikelas');
		}
	}

	public function activateSchoolInternal($id)
	{
		try {
			DB::table('school_internal')->where('id', '=', $id)
				->update([
					"active" => 'Y',
					'update_at' => new \Datetime('now')
				]);

			DB::table('m_si_class')->where('school_internal_id', '=', $id)
				->update([
					"active" => 'Y',
					'update_at' => new \Datetime('now')
				]);

			Session::flash('message', 'Data berhasil disunting!');
			return redirect('/auth/internal/input-walikelas');
		} catch (\Throwable $e) {
			Log::error('Activate School Internal Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/auth/internal/input-walikelas');
		}
	}

	public function deactivateSchoolInternal($id)
	{
		try {
			DB::table('school_internal')->where('id', '=', $id)
				->update([
					"active" => 'N',
					'update_at' => new \Datetime('now')
				]);

			DB::table('m_si_class')->where('school_internal_id', '=', $id)
				->update([
					"active" => 'N',
					'update_at' => new \Datetime('now')
				]);

			Session::flash('message', 'Data berhasil disunting!');
			return redirect('/auth/internal/input-walikelas');
		} catch (\Throwable $e) {
			Log::error('Activate School Internal Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/auth/internal/input-walikelas');
		}
	}

	public function indexLegalization()
	{

		$headmaster = Constant::where('code', 'LIKE', 'KEPALA_SEKOlAH')->first();
		$stample = Constant::where('code', 'LIKE', 'STAMPLE')->first();
		$signature = Constant::where('code', 'LIKE', 'TTD')->first();

		$attribute = [
			'headmaster' => $headmaster->value,
			'signature' => $signature->value,
			'stample' => $stample->value
		];
		return view('internal/legalization', ['attribute' => $attribute]);
	}

	public function updateLegalization(Request $request)
	{
		\Log::debug($request->all());
		try {
			if (isset($request->headmaster)) {
				$headmaster = Constant::where('code', 'LIKE', 'KEPALA_SEKOlAH')
					->update([
						'value' => $request->headmaster
					]);
			}

			if (isset($request->signature)) {
				$signature = $request->signature;
				$signature->storeAs('schoolInternalSignature', 'signature.png');
			}

			if (isset($request->stample)) {
				$signature = $request->stample;
				$signature->storeAs('schoolInternalSignature', 'stamp.png');
			}


			Session::flash('message', 'Data berhasil disunting!');
			return redirect()->back();
		} catch (\Exception $e) {
			Log::error($e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect()->back();
		}
	}
}
