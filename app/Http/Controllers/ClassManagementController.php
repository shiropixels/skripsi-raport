<?php

namespace App\Http\Controllers;

use App\MStudentClass;
use Illuminate\Http\Request;

use DB;

use Log;

use Session;

use App\Raport;

use App\Support\Utilities;

class ClassManagementController extends Controller
{
    public function getPage()
    {
        $data = DB::table('class as c')
            ->select(
                'c.id as id',
                DB::raw('CONCAT(c.grade, " ", c.major, " ", c.name) as name'),
                DB::raw('CONCAT(c.grade, " ", c.major) as class_specification'),
                'c.grade as grade',
                'c.active as active'
            )
            ->where('c.active', '=', 'Y')
            ->get();

        $resultSet = [];
        $registered = [];

        foreach ($data as $set) {
            if (!in_array($set->class_specification, $registered)) {
                $classMaster = new ClassMasterFactory(
                    $set->class_specification,
                    $set->grade,
                    []
                );

                array_push($resultSet, $classMaster);
                array_push($registered, $set->class_specification);
            } else continue;
        }

        foreach ($resultSet as $set) {
            $nana = [];

            foreach ($data as $item) {
                if ($item->class_specification == $set->class_specification) {
                    array_push($nana, new ClassFactory(
                        $item->id,
                        $item->name,
                        $item->active
                    ));
                }
            }

            $set->class_list = $nana;
        }

        return view('internal/class-management/class-management-main')
            ->with('data', $resultSet);
    }

    public function getClassById($id)
    {
        $filter = array([
            'msc.class_id', '=', $id
        ], [
            'msc.active', 'like', 'Y'
        ]);

        $all_teacher = DB::select(
            DB::raw('SELECT * FROM school_internal as s WHERE NOT EXISTS (SELECT * FROM m_si_class as msc WHERE (s.id = msc.school_internal_id) AND msc.active = "Y") AND s.role_id = 2 AND s.active = "Y"')
        );

        $all_student = DB::select(
            DB::raw('SELECT * FROM student as s WHERE NOT EXISTS (SELECT * FROM m_student_class as msc WHERE (s.id = msc.student_id) AND msc.active = "Y") AND s.active = "Y"')
        );

        $class = DB::table('class as c')
            ->select(
                'c.id as id',
                DB::raw('CONCAT(c.grade, " ", c.major, " ", c.name) as name')
            )
            ->where('c.id', '=', $id)
            ->first();

        $s_internals = DB::table('m_si_class as msc')
            ->leftJoin('school_internal as si', 'si.id', '=', 'msc.school_internal_id')
            ->where($filter)
            ->select('si.id as school_internal_id', 'si.name as name', 'msc.active as active')
            ->get();

        $students = DB::table('m_student_class as msc')
            ->leftJoin('student as s', 's.id', '=', 'msc.student_id')
            ->where($filter)
            ->select('s.id as student_id', 's.name as name', 'msc.active as active')
            ->get();

        #Tombol Nuklir Settings
        $getCurrentMonth = (int) date('m');
        $getCurrentDate = (int) date('d');
        $enableButton = false;

        // if($getCurrentMonth == 12)
        //         if($getCurrentDate != 31)
                    $enableButton = true;

        return view('internal/class-management/class-detail')
            ->with('class', $class)
            ->with('change_semester', $enableButton)
            ->with('all_teacher', $all_teacher)
            ->with('all_student', $all_student)
            ->with('s_internals', $s_internals)
            ->with('students', $students);
    }

    public function createClass(Request $request)
    {
        try {
            DB::table('class')->insert([
                "name" => $request->get('class_name'),
                "major" => $request->get('major'),
                "grade" => $request->get('grade'),
                'active' => 'Y',
                'create_at' => new \Datetime('now'),
                'update_at' => new \Datetime('now')
            ]);

            Session::flash('message', 'Data Berhasil Ditambahkan!');
            return redirect('/class-management');
        } catch (\Throwable $e) {
            Log::error('Add Class Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return redirect('/class-management');
        }
    }

    public function deactivateSchoolInternal($id)
    {
        try {
            DB::table('m_si_class as msc')
                ->where('msc.school_internal_id', '=', $id)
                ->update([
                    "active" => 'N',
                    'update_at' => new \Datetime('now')
                ]);

            Session::flash('message', 'Data Berhasil Disunting!');
            return back();
        } catch (\Throwable $e) {
            Log::error('Deactivating School Internal Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }

    public function deactivateStudent($id)
    {
        try {
            DB::table('m_student_class as msc')
                ->where('msc.student_id', '=', $id)
                ->update([
                    "active" => 'N',
                    'update_at' => new \Datetime('now')
                ]);

            Session::flash('message', 'Data Berhasil Disunting!');
            return back();
        } catch (\Throwable $e) {
            Log::error('Deactivating School Internal Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }

    public function assignSchoolInternalToClass(Request $request)
    {
        try {
            $school_year = Utilities::createSchoolYear();

            for ($i = 0; $i < count($request->get('walikelas')); $i++) {
                if ($request->get('walikelas')[$i] == null) continue;

                DB::table('m_si_class')
                    ->insert([
                        "class_id" => $request->get('class_id'),
                        "school_internal_id" => $request->get('walikelas')[$i],
                        "start_year" => $school_year["start_year"],
                        "end_year" => $school_year["end_year"],
                        'active' => 'Y',
                        'create_at' => new \Datetime('now'),
                        'update_at' => new \Datetime('now')
                    ]);
            }

            Session::flash('message', 'Data Berhasil Ditambahkan!');
            return back();
        } catch (\Throwable $e) {
            Log::error('Assign School Internal to Class Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }

    public function assignStudentToClass(Request $request)
    {
        try {
            $school_year = Utilities::createSchoolYear();

            $raport = Raport::create([
                "semester" => Utilities::createSemester(),
                "absent" => 0,
                'create_at' => new \Datetime('now'),
                'update_at' => new \Datetime('now')
            ]);

            DB::table('m_student_class')
                ->insert([
                    "raport_id" => $raport->id,
                    "class_id" => $request->get('class_id'),
                    "student_id" => $request->get('student_id'),
                    "start_year" => $school_year["start_year"],
                    "end_year" => $school_year["end_year"],
                    'active' => 'Y',
                    'create_at' => new \Datetime('now'),
                    'update_at' => new \Datetime('now')
                ]);

            Session::flash('message', 'Data Berhasil Ditambahkan!');
            return back();
        } catch (\Throwable $e) {
            Log::error('Assign student to class Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }

    public function deactivateClass($id)
    {
        try {
            DB::table('class as class')
                ->where('class.id', '=', $id)
                ->update([
                    "active" => 'N',
                    'update_at' => new \Datetime('now')
                ]);

            Session::flash('message', 'Data menyunting data!');
            return back();
        } catch (\Throwable $e) {
            Log::error('Deactivating S Error: ' . $e->getMessage());

            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }

    public function createMappingCourse(Request $request)
    {
        $json = null;
        try {
            DB::table('m_mp_class')
                ->insert([
                    "class_id" => $request->get('class_id'),
                    "course_id" => $request->get('course_id'),
                    'update_at' => new \Datetime('now'),
                    'create_at' => new \Datetime('now'),
                    "active" => 'Y'
                ]);

            $json = new BaseResponse(true, 200, "Success creating data");
        } catch (\Throwable $e) {
            $json = new BaseResponse(false, 500, $e->getMessage());
            Log::error('Creating Mapping Course error: ' . $e->getMessage());
        }

        return response()->json($json);
    }

    public function deleteMappingCourse(Request $request)
    {
        $json = null;
        try {
            DB::table('m_mp_class as mmc')
                ->where(array([
                    'mmc.course_id', '=', $request->get('course_id')
                ], [
                    'mmc.class_id', '=', $request->get('class_id')
                ]))
                ->update([
                    'update_at' => new \Datetime('now'),
                    "active" => 'N'
                ]);

            $json = new BaseResponse(true, 200, "Success creating data");
        } catch (\Throwable $e) {
            $json = new BaseResponse(false, 500, "Terjadi kesalahan! Silahkan hubungi system!");
            Log::error('Delete Mapping: ' . $e->getMessage());
        }

        return response()->json($json);
    }

    public function changeSemester($id)
    {
        DB::beginTransaction();
        try {
            //AMBIL CLASS YANG AKTIF
            $student_class = MStudentClass::where('class_id', '=', $id)
                ->where('active', '=', 'Y')
                ->get();
            \Log::debug($student_class);
            //SET JADI NON AKTIF
            $student_class_disable = MStudentClass::where('class_id','=',$id)
            ->where('active','=','Y')
            ->update([
                'active' => 'N'
            ]);

            foreach($student_class as $data){
                $raport = new Raport;
                $raport->semester = 2;
                $raport->absent = 0;
                $raport->create_at = new \Datetime('now');
                $raport->update_at = new \Datetime('now');
                $raport->save();

                if(isset($raport)) {
                    $new_student_class = new MStudentClass;
                    $new_student_class->student_id = $data->student_id;
                    $new_student_class->class_id = $id;
                    $new_student_class->raport_id = $raport->id;
                    $new_student_class->start_year = $data->start_year;
                    $new_student_class->end_year = $data->end_year;
                    $new_student_class->create_at = new \Datetime('now');
                    $new_student_class->update_at = new \Datetime('now');
                    $new_student_class->active = 'Y';
                    $new_student_class->save();
                }
            }
            DB::commit();
            Session::flash('message', 'Data Berhasil Diubah!');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            // $json = new BaseResponse(false, 500, "Terjadi kesalahan! Silahkan hubungi system!");
            Log::error('Change semester: ' . $e->getMessage());
            Session::flash('error', 'Terjadi kesalahan. Silahkan hubungi admin!');
            return back();
        }
    }
}

class BaseResponse
{
    public $status;
    public $code;
    public $message;

    public function __construct($s, $c, $m)
    {
        $this->status = $s;
        $this->code = $c;
        $this->message = $m;
    }
}

class ClassMasterFactory
{
    public $class_specification;
    public $grade;
    public $class_list;

    public function __construct($c, $g, $cl)
    {
        $this->class_specification = $c;
        $this->grade = $g;
        $this->class_list = $cl;
    }
}

class ClassFactory
{
    public $id;
    public $name;
    public $active;

    public function __construct($i, $n, $a)
    {
        $this->id = $i;
        $this->name = $n;
        $this->active = $a;
    }
}
