<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\SchoolInternal;
use App\StudentClass;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mata_pelajaran;
use App\Rapor_header;
use App\Raport;

use Log;

class StudentController extends Controller
{

  public function IndexLoginStudent()
  {
    return view('/student/login-siswa-view');
  }

  public function LoginStudent(Request $request)
  {
    $validate = Validator::make($request->all(), [
      "email" => 'required',
      "password" => 'required'
    ]);


    if ($validate->fails()) {
      $error = $validate->errors()->first();

      Session::flash('error', $error);
      return redirect('/student/LoginStudent');
    }

    $data = DB::table('student')
      ->where(array(
        ['email', '=', $request->get('email')]
      ))
      ->get()->first();

    if (!isset($data)) {
      Session::flash('error', 'Autentikasi error! Cek kembali username dan kata sandi anda');
      return redirect('/student/LoginStudent');
    }

    if (!Hash::check($request->get('password'), $data->password)) {
      Session::flash('error', 'Kata sandi salah ! Cek kembali kata sandi anda!');
      return redirect('/student/LoginStudent');
    }


    Session::put('student', $data);
    Session::put('class', StudentClass::all());
    return redirect('/student/student-dashboard');
  }

  public function  LogoutStudent()
  {
    Session::flush();
    return redirect('/student/LoginStudent');
  }

  public function IndexGetSiswa()
  {
    $students = DB::table('student AS A')
      ->join('m_student_class as B', 'A.id', '=', 'B.student_id')
      ->join('class as C', 'C.id', '=', 'B.class_id')
      ->where('B.active', '=', 'Y')
      ->select('A.id', 'A.name', 'C.name as class_name', 'A.code', 'A.email', 'A.phone', 'A.active')
      ->get();

    return view('/internal/input-student')
      ->with('students', $students);
  }


  public function DataSiswa($class)
  {
    $tbl_student = Student::all();
    $tbl_student = DB::table('class AS k')
      ->select('*')
      ->join('student', 'class_id', '=', 'k.id')
      ->where('class_id', '=', $class)
      ->get();
    //ini untuk ngeshow nama siswa berdasarkan class yang dia sekarang
    return view('/internal/DaftarSiswaPerclass', compact('tbl_student'));
  }

  public function getDataWaliKelas(Request $request)
  {
    $school_internal = SchoolInternal::all();
    $school_internal = DB::table('school_internal as si')
      ->join('role as r', 'r.id', '=', 'si.role_id')
      ->join('class as k', 'k.id', '=', 'si.class_id')
      ->select('*')
      ->where('si.role_id', '!=', '1')
      ->get();
    //ini untuk mengshow data waliclass di bagian dashboard siswa menu list waliclass



    return view('/student/DataWaliKelas', compact('school_internal'));
  }

  public function IndexNilaiSiswa($id)
  {

    $student = Student::find($id);

    $school_internal = DB::select("SELECT A.name, A.phone, B.class_id
      FROM school_internal A
      INNER JOIN m_si_class B ON A.id = B.school_internal_id
      INNER JOIN class C ON B.class_id = C.id
      INNER JOIN m_student_class D ON C.id = D.class_id
      WHERE D.student_id = :id
      AND B.start_year = D.start_year
      AND B.end_year = D.end_year
    ",['id' => $id]);

    $raport_items = DB::select('SELECT C.name AS class_name, 
									C.grade,
									C.major,
                  B.class_id,
									B.start_year, 
									B.end_year,
									D.id AS raport_id,
									D.semester,
									D.absent

		 FROM student A
		 INNER JOIN m_student_class B ON A.id = B.student_id
		 INNER JOIN class C ON B.class_id = C.id
		 LEFT JOIN raport D ON B.raport_id = D.id
		 WHERE A.id = :id', [
      'id' => $id
    ]);
    \Log::info($raport_items);
    foreach ($raport_items as $items) {
      if (isset($items->raport_id)) {
        $items->detail = DB::select('SELECT 
												B.id,
												B.score,
												B.practicume,
												B.description,
												C.name AS course_name,
												C.min_grade

				FROM raport A
				LEFT JOIN raport_detail B ON A.id = B.raport_id
				INNER JOIN course C ON B.course_id = C.id
				WHERE A.id = :id', [
          'id' => $items->raport_id
        ]);
      }
    }
  
    $raport = [
      'student' => $student,
      'school_internal' => $school_internal,
      'raport_items' => $raport_items,

    ];

    \Log::debug($raport);
    return view('/student/NilaiSiswa', [
      'raport' => $raport
    ]);

  }


  public function storeSiswa(Request $request)
  {
    $student = new StudentImport();
    $data = Excel::import($student, $request->file('select_file'));

    return redirect('/student/internal/input-student')->with('success', 'Data Siswa Telah Masuk');
  }
  public function TambahSiswa()
  {
    $class = StudentClass::all();

    return view('/internal/TambahDataSiswa')
      ->with('class', $class);
  }

  public function StoreTambahSiswa(Request $request)
  {
    try {
      for ($i = 0; $i < count($request->get('name')); $i++) {
        $Tbl_student = DB::table('student')->insert([
          'name' => $request->get('name')[$i],
          'code' => $request->get('nis')[$i],
          'email' => $request->get('email')[$i],
          'phone' => $request->get('phone')[$i],
          'password' => Hash::make($request->get('password')[$i]),
          'active' => 'Y',
          'profile_picture' => '',
          'create_at' => new \Datetime('now'),
          'update_at' => new \Datetime('now')
        ]);
      }

      Session::flash('message', 'Data Berhasil Ditambahkan!');
      return redirect('/student/internal/input-student');
    } catch (\Throwable $e) {
      Log::error('Add Student Error: ' . $e->getMessage());

      Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
      return redirect('/student/internal/input-student');
    }
  }

  public function editSiswa($id)
  {
    $students = Student::find($id);

    return view('/internal/EditDataSiswa')
      ->with('students', $students)
      ->with('class', StudentClass::all());
  }

  public function updateSiswa(Request $request, $id)
  {
    try {
      DB::table('student')
        ->where('id', '=', $id)
        ->update([
          "name" => $request->get('name'),
          "code" => $request->get('nis'),
          "email" => $request->get('email'),
          "phone" => $request->get('phone'),
          "update_at" => new \DateTime('now')
        ]);

      Session::flash('message', 'Data Berhasil Disunting!');
      return redirect('/student/internal/input-student');
    } catch (\Throwable $e) {
      Log::error('Edit Student Error: ' . $e->getMessage());

      Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
      return redirect('/student/internal/input-student');
    }
  }

  public function deleteSiswa($id)
  {
    try {
      Student::where('id', $id)->delete();

      Session::flash('message', 'Data Berhasil Dihapus!');
      return redirect('/student/internal/input-student');
    } catch (\Throwable $e) {
      Log::error('Delete Student Error: ' . $e->getMessage());

      Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
      return redirect('/student/internal/input-student');
    }
  }

  public function deactivateStudent($id)
  {
    try {
      DB::table('student')->where('id', '=', $id)
        ->update([
          "active" => 'N',
          'update_at' => new \Datetime('now')
        ]);

      Session::flash('message', 'Data berhasil disunting!');
      return redirect('/student/internal/input-student');
    } catch (\Throwable $e) {
      Log::error('Deactive Student Error: ' . $e->getMessage());

      Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
      return redirect('/student/internal/input-student');
    }
  }

  public function activateStudent($id)
  {
    try {
      DB::table('student')->where('id', '=', $id)
        ->update([
          "active" => 'Y',
          'update_at' => new \Datetime('now')
        ]);

      Session::flash('message', 'Data berhasil disunting!');
      return redirect('/student/internal/input-student');
    } catch (\Throwable $e) {
      Log::error('Activate Student Error: ' . $e->getMessage());

      Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
      return redirect('/student/internal/input-student');
    }
  }
}

class ShowRaport
{
  public $student_id;
  public $rapor_id;
  public $raport_headers;

  public function __construct($a, $b, $c)
  {
    $this->student_id = $a;
    $this->rapor_id = $b;
    $this->raport_headers = $c;
  }
}

class ShowRaporHeader
{
  public $rapor_header_id;
  public $semester;
  public $grade;
  public $tahun_ajaran;
  public $mata_pelajarans;

  public function __construct($a, $b, $c, $d, $e)
  {
    $this->rapor_header_id = $a;
    $this->semester = $b;
    $this->grade = $c;
    $this->tahun_ajaran = $d;
    $this->mata_pelajarans = $e;
  }
}
