<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mata_pelajaran;
use App\Constant;
use DB;
use App\Rapor_header;
use App\Raport;
use App\Rapor_Detail;
use App\Student;
use App\StudentClass;
use App\Imports\RaportImport;
use App\Exports\MataPelajaranExport;

use App\Exports\MappingRapot;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exporter;

use Session;
use PDF;

use Log;

class CourseController extends Controller
{
	private function getTahunAjaran()
	{
		$tahunAjaran = "";

		$currentDate = new \DateTime("now");

		$currentYear = $currentDate->format('yy');

		$epoch1Juli = strtotime("1 July {$currentYear}"); //Epoch


		if (time() < $epoch1Juli) {
			$tahunKemarin = (int) $currentYear - 1;
			$tahunAjaran = $tahunKemarin . "/" . $currentYear;
		} else if (time() > $epoch1Juli) {
			$tahunDepan = (int) $currentYear + 1;
			$tahunAjaran = $currentYear . "/" . $tahunDepan;
		}

		//kalau dibawah juli dia itu x-1/x
		//kalau diatas bulan juli x/x+1

		return $tahunAjaran;
	}

	private function parseTahunAjaran($string)
	{
		$tahun = $string;

		for ($i = 0; $i < strlen($tahun); $i++) {
			if ($tahun[$i] == '-') {
				$tahun[$i] = '/';
			}
		}

		//buat membaca format tahun ajaran di excel



		return $tahun;
	}

	private function createSemester()
	{
		$currentDate = new \DateTime("now");
		//kalau bulan yang diambil lebih  dari juli dia semester 1 
		//kalau kurang dari bulan 7 dia semester 2
		if ($currentDate->format('m') > 7)
			return 1;



		return 2;
	}

	public function indexCourse($id)
	{
		$student = Student::find($id);

		$raport_items = DB::select('SELECT C.name AS class_name, 
									C.grade,
									C.major,
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
			'raport_items' => $raport_items,

		];

		return view('/internal/student-grade-list', [
			'raport' => $raport,
		]);
	}


	public function storeMataPelajaranTambah(Request $request)
	{
		$this->validate($request, [
			'nama_mata_pelajaran' => 'required',
			'kkm' => 'required'

		]);

		Mata_pelajaran::create([
			'nama_mata_pelajaran' => $request->name_mata_pelajaran,
			'kkm' => $request->kkm

		]);

		return redirect('');
	}


	public function storeMataPelajaran(Request $request)
	{
		if (!$request->hasFile('select_file')) {
			return redirect()->back(); //Kalo gaada filenya, balikin ke page tadi
		}

		#Parsing Name Filenya untuk get Student ID, class, Semester, sama Tahun Ajaran
		$filename = pathinfo($request->file('select_file')->getClientOriginalName(),  PATHINFO_FILENAME);
		$flagMinPertama = -1;
		$flagMinKedua  = -1;
		$flagMinKetiga = -1;

		for ($i = 0; $i < strlen($filename); $i++) {
			if ($filename[$i] == '-') {
				if ($flagMinPertama == -1) {
					$flagMinPertama = $i;
				} else if ($flagMinKedua == -1) {
					$flagMinKedua = $i;
				} else if ($flagMinKetiga == -1) {
					$flagMinKetiga = $i;
				}
			}
		}

		$studentId = substr($filename, 0, $flagMinPertama);
		$Grade = substr($filename, $flagMinPertama + 1, ($flagMinKedua - $flagMinPertama) - 1);
		$ganjilGenap = substr($filename, $flagMinKedua + 1, ($flagMinKetiga - $flagMinKedua) - 1);
		$tahunAjaran = substr($filename, $flagMinKetiga + 1, (strlen($filename) - $flagMinKetiga) - 1);


		if ($flagMinPertama == -1) {
			Session::flash('error', 'Nama file tidak sesuai!');
			return redirect('/pelajaran/internal/import-grade');
		}

		if ($flagMinKedua == -1) {
			Session::flash('error', 'Nama file tidak sesuai!');
			return redirect('/pelajaran/internal/import-grade');
		}

		if ($flagMinKetiga == -1) {
			Session::flash('error', 'Nama file tidak sesuai!');
			return redirect('/pelajaran/internal/import-grade');
		}




		$student_Id = Student::find($studentId);



		if ($student_Id == null) {
			Session::flash('error', 'Murid dengan id ' . $studentId . ' tidak ditemukan!');
			return redirect('/pelajaran/internal/import-grade');
		}


		$class = StudentClass::find($student_Id->class_id);


		if ($class->grade  != $Grade) {
			Session::flash('error', 'Data nilai yang anda masukan untuk ' . $student_Id->name . ' tidak valid Karena Gradenya beda! Silahkan cek kembali class murid dan nama file yang anda upload!');
			return redirect('/pelajaran/internal/import-grade');
		}

		#Check raport sesuai student id
		$raport = DB::table('raports')
			->select('*')
			->where('student_id', '=', $studentId)
			->get()
			->first();



		if (!isset($raport)) {
			$raport = new Raport();
			$raport->student_id = $studentId;
			$raport->create_at = new \DateTime('now');
			$raport->save();
		}
		//code ini untuk menghindari duplikat data ketika pas mau import

		//Check Raport Header berdasarkan Tahun Ajaran dan semester
		$raport_header = DB::table('rapor_headers as rh')
			->select('*')
			->where('rh.rapor_id', '=', $raport->id)
			->where('rh.tahun_ajaran', '=', $this->parseTahunAjaran($tahunAjaran))
			->where('rh.semester', '=', $ganjilGenap)
			->orderBy('rh.tahun_ajaran', 'asc')
			->get()
			->first();


		if (!isset($raport_header)) {
			$raport_header = new Rapor_header();
			$raport_header->rapor_id = $raport->id;
			$raport_header->tahun_ajaran = $this->parseTahunAjaran($tahunAjaran);
			$raport_header->semester = ($ganjilGenap);
			$raport_header->grade = ($Grade);
			$raport_header->save();
			Session::put('new_raport_header', true);
		}
		//code ini menghindari duplikat data ketika mau import



		Session::put('raport_header_id', $raport_header->id);
		//gunanya session put ini dikarenakan import tidak bisa mengirim parameter konstan jadi kita save sebagai global varible
		// Session::put('rapor_header_id',$raport->id);

		$mata_pelajaran = new MataPelajaranImport();

		$data = Excel::import($mata_pelajaran, $request->file('select_file'));
		//function import meningimport mata pelajaran sebagai model utama di excel
		//select file tipe format excel
		//sebuah recursive yang menkovert file excel ke file hash map

		Session::forget('raport_header_id');
		Session::forget('new_raport_header');
		// Session::forget('rapor_header_id');

		Session::flash('success', 'Sukses memasukan nilai siswa!');

		return redirect('/pelajaran/internal/import-grade');
	}


	public function tambahMataPelajaran()
	{
		return view('');
	}



	public function editMataPelajaran($id)
	{
		$mata_pelajaran = Mata_pelajaran::find($id);
		return view('', ['' => $pelajaran]);
	}

	public function updateMataPelajaran($id, Request $request)
	{
		$validate = $this->validate(
			$request,
			[
				'nama_mata_pelajaran' => 'required',
				'kkm' => 'required',

			],
			[
				'nama_mata_pelajaran.required' => 'Pelajaran Waji Diisi',
				'kkm.required' => 'Kkm Waji diisi',

			]
		);


		Mata_pelajaran::create([
			'nama_mata_pelajaran' => $request->name_mata_pelajaran,
			'kkm' => $request->kkm
		]);

		return redirect('/auth/internal/input-walikelas')->with(['success' => 'data berhasil diubah']);
	}

	public function deleteMataPelajaran($id)
	{
		$mata_pelajaran = MataPelajaran::find($id);
		$mata_pelajaran->delete();
		return redirect('');
	}


	public function indexImportGrade($id)
	{


		$class = DB::table('school_internal AS A')
			->select(
				'C.start_year',
				'C.end_year',
				'D.id as class_id',
				'D.name as class_name',
				'D.major',
				'D.grade'
			)
			->join('role as B', 'A.role_id', "=", 'B.id') //harus tau rolenya waliclass
			->join('m_si_class as C', 'A.id', '=', 'C.school_internal_id') //harus megang spesifik class
			->join('class as D', 'C.class_id', '=', 'D.id')
			->where('A.id', '=', $id)
			->where('B.name', '=', 'WaliKelas')
			->where('C.active', '=', 'Y')
			->first();

		$students = [];

		if (isset($class)) {
			$students = DB::table('student as A')
				->select('A.id', 'A.name', 'A.code', 'A.phone')
				->join('m_student_class as B', 'A.id', '=', 'B.student_id')
				->where('B.class_id', '=', $class->class_id)
				->where('B.start_year', '=', $class->start_year)
				->where('B.end_year', '=', $class->end_year)
				->where('B.active', '=', 'Y')->get();
		}


		return view('/internal/import-grade', ['class' => $class, 'students' => $students]);
	}

	public function downloadUploadGuide()
	{
		\Log::debug('masuk sini');
		try {
			//code...
			return response()->download(public_path('/report/panduan_upload.zip'));
		} catch (\Exception $ex) {
			\Log::debug($ex->getMessage());
			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect()->back();
		}
	}

	public function exportNilai($id)
	{
		try {
			$student = Student::find($id);
			\Log::debug($student);
			$raport_items = DB::select("SELECT C.name AS class_name, 
									C.grade,
									C.major,
									B.start_year, 
									B.end_year,
									D.id AS raport_id,
									D.semester,
									D.absent,
									DATE_FORMAT(D.create_at, '%d %M %Y') AS create_at,
									DATE_FORMAT(D.update_at, '%d %M %Y') AS update_at

		 FROM student A
		 INNER JOIN m_student_class B ON A.id = B.student_id
		 INNER JOIN class C ON B.class_id = C.id
		 LEFT JOIN raport D ON B.raport_id = D.id
		 WHERE A.id = :id", [
				'id' => $id
			]);

			foreach ($raport_items as $items) {
				if (isset($items->raport_id)) {
					$items->detail = DB::select("SELECT 
												B.id,
												B.score,
												B.practicume,
												CASE
													WHEN B.score >= 90 THEN 'A'
													WHEN B.score >= 80 THEN 'B'
													WHEN B.score >= 70 THEN 'C'
													WHEN B.score >= 60 THEN 'D'
													ELSE 'F'
												END AS score_grade,
												CASE
													WHEN B.practicume >= 90 THEN 'A'
													WHEN B.practicume >= 80 THEN 'B'
													WHEN B.practicume >= 70 THEN 'C'
													WHEN B.practicume >= 60 THEN 'D'
													ELSE 'F'
												END AS practicume_grade,
												B.description,
												C.name AS course_name,
												C.min_grade
				FROM raport A
				LEFT JOIN raport_detail B ON A.id = B.raport_id
				INNER JOIN course C ON B.course_id = C.id
				WHERE A.id = :id", [
						'id' => $items->raport_id
					]);
				}
			}
			$headmaster = Constant::where('code','LIKE','KEPALA_SEKOlAH')->first();
			$stample = Constant::where('code','LIKE','STAMPLE')->first();
			$signature = Constant::where('code','LIKE','TTD')->first();
			$raport = [
				'student' => $student,
				'raport_items' => $raport_items,
				'headmaster' => $headmaster->value,
				'stample'		=> $stample->value,
				'signature' => $signature->value

			];
			\Log::debug($raport);
			$pdf = PDF::loadview('/internal/export-pdf-student-grade-list', [
				'raport' => $raport
			]);
			return $pdf->download($student->code . '_' . $student->name . '_penilaian');
		} catch (\Exception $ex) {
			\Log::debug($ex->getMessage());
			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect()->back();
		}
	}

	public function importStudentGrade(Request $request)
	{
		try {
			$import = new RaportImport();
			$excel = Excel::import($import, $request->file('student_grade'));
			\Log::debug('inserted: '.$import->inserted);
			\Log::debug('missing: '.$import->missing);
			Session::flash('message', 'Sukses melakukan import, data yang masuk ' . $import->inserted . ' data, dan data yang missing ' . $import->missing . ' data.');
			return redirect()->back()->with(['success' => 'Sukses melakukan import, data yang masuk ' . $import->inserted . ' data, dan data yang missing ' . $import->missing . ' data.']);
		} catch (Exception $ex) {
			\Log::debug($ex->getMessage());
			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect()->back();
		}
	}

	#Course Management Start from here#
	public function getCourseManagementPage()
	{
		$resultSet = DB::table('course as c')
			->where('c.active', '=', 'Y')
			->get();

		return view('/internal/course-management/course-management-main')
			->with('data', $resultSet);
	}

	public function createCourse(Request $request)
	{
		try {
			DB::table('course')
				->insert([
					"name" => $request->get('name'),
					"min_grade" => $request->get('kkm'),
					'active' => 'Y',
					'create_at' => new \Datetime('now'),
					'update_at' => new \Datetime('now')
				]);

			Session::flash('message', 'Data Berhasil Ditambahkan!');
			return redirect('/course-management');
		} catch (\Throwable $e) {
			Log::error('Deactivating S Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/course-management');
		}
	}

	public function deleteCourse($id)
	{
		try {
			DB::table('course as c')
				->where('c.id', '=', $id)
				->update([
					"active" => 'N',
					'update_at' => new \Datetime('now')
				]);

			DB::table('m_mp_class as mmc')
				->where('mmc.course_id', '=', $id)
				->update([
					"active" => 'N',
					'update_at' => new \Datetime('now')
				]);

			Session::flash('message', 'Berhasil menyunting data!');
			return redirect('/course-management');
		} catch (\Throwable $e) {
			Log::error('Deactivating Course Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/course-management');
		}
	}

	public function updateCourse(Request $request)
	{
		try {
			DB::table('course as c')
				->where('c.id', '=', $request->get('id'))
				->update([
					'name' => $request->get('name'),
					'min_grade' => $request->get('kkm'),
					'update_at' => new \Datetime('now')
				]);

			Session::flash('message', 'Berhasil menyunting data!');
			return redirect('/course-management');
		} catch (\Throwable $e) {
			Log::error('Deactivating Course Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return redirect('/course-management');
		}
	}

	public function updateScore(Request $request)
	{
		try {
			DB::table('raport_detail as rh')
				->where('rh.id', '=', $request->get('rh_id'))
				->update([
					'score' => $request->get('score'),
					'practicume' => $request->get('practicume'),
					'description' => $request->get('description')
				]);

			Session::flash('message', 'Berhasil menyunting data!');
			return back();
		} catch (\Throwable $e) {
			Log::error('Update Score Error: ' . $e->getMessage());

			Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
			return back();
		}
	}
}

// class ShowRaport
// {
// 	public $student_id;
// 	public $rapor_id;
// 	public $raport_headers;

// 	public function __construct($a, $b, $c)
// 	{
// 		$this->student_id = $a;
// 		$this->rapor_id = $b;
// 		$this->raport_headers = $c;
// 	}
// }

// class ShowRaporHeader
// {
// 	public $rapor_header_id;
// 	public $semester;
// 	public $grade;
// 	public $tahun_ajaran;
// 	public $mata_pelajarans;

// 	public function __construct($a, $b, $c, $d, $e)
// 	{
// 		$this->rapor_header_id = $a;
// 		$this->semester = $b;
// 		$this->grade = $c;
// 		$this->tahun_ajaran = $d;
// 		$this->mata_pelajarans = $e;
// 	}
// }


//ini model untuk merepresentasikan data dari database ke view 
//di DB itu joinya untuk mendapatkan hasil passing multiple query tidak sesuai expektasi 
//jadi kami melakukan join manual dengan logic layer dengan menngunakan class tersebut sebagai representasi data