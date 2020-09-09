<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SchoolInternal;
use App\Student;
use App\Course;

use DB;

class ModalAjaxController extends Controller
{
    //School Internal
    public function getSchoolInternalById($id){
        return view('internal/school-internal-functions/school-internal-detail-modal')
                ->with('data', SchoolInternal::find($id));
    }

    public function getActivateSchoolInternalModal($id){
        return view('internal/school-internal-functions/school-internal-activate-modal')
                ->with('data', SchoolInternal::find($id));
    }

    public function getDeactivateSchoolInternalModal($id){
        return view('internal/school-internal-functions/school-internal-deactive-modal')
                ->with('data', SchoolInternal::find($id));
    }

    //Students
    public function getStudentById($id){
        return view('internal/student-functions/student-detail-modal')
            ->with('data', Student::find($id));
    }

    public function getActivateStudentModal($id){
        return view('internal/student-functions/student-activate-modal')
            ->with('data', Student::find($id));
    }

    public function getDeactivateStudentModal($id){
        return view('internal/student-functions/student-deactive-modal')
            ->with('data', Student::find($id));
    }

    //Class Management
    public function getDeactivateClassModal($id){
        $data = $class = DB::table('class as c')
        ->select('c.id as id', 
            DB::raw('CONCAT(c.grade, " ", c.major, " ", c.name) as name'))
        ->where('c.id', '=', $id)
        ->first();

        return view('internal/class-management/functions-main/delete-class')
            ->with('data', $data);
    }

    public function getDeactivateClassSchoolInternal($id){
        return view('internal/class-management/functions-class-detail/deactivate-walikelas')
            ->with('data', SchoolInternal::find($id));
    }

    public function getDeactivateClassStudent($id){
        return view('internal/class-management/functions-class-detail/deactivate-student')
            ->with('data', Student::find($id));
    }

    public function getClassCourseMapping($id){
        $map = DB::select(DB::raw('
            SELECT 
                c.id as id, 
                c.name as name, 
                IF (EXISTS (SELECT *
                FROM m_mp_class as mmc 
                WHERE mmc.class_id = '.$id.' 
                        AND mmc.course_id = c.id
                        AND mmc.active = "Y"), 1, 0) as ada
            FROM course as c 
            WHERE c.active = "Y"
        '));

        $count = DB::select(DB::raw('SELECT COUNT(mmc.class_id) as course_total FROM m_mp_class as mmc WHERE mmc.class_id = '.$id.' AND mmc.active = "Y"'));
        $all_course = DB::select(DB::raw('SELECT COUNT(c.id) as all_course FROM course as c WHERE c.active = "Y"'));

        return view('internal/class-management/functions-class-detail/map-class-and-course')
            ->with('id', $id)
            ->with('counter_non_mapped', $all_course[0]->all_course - $count[0]->course_total)
            ->with('counter', $count[0]->course_total)
            ->with('data', $map);
    }

    //Course management
    public function getCourseEditModal($id){
        return view('internal/course-management/function/edit-course-modal')
            ->with('data', Course::find($id));
    }

    public function getCourseDeleteModal($id){
        return view('internal/course-management/function/delete-course-modal')
            ->with('data', Course::find($id));
    }

    //Score Management
    public function getScoreEditModal($id){
        $data = DB::table('raport_detail as rd')
            ->leftJoin('course as c', 'c.id', '=', 'rd.course_id')
            ->select('rd.*', 'c.name as course_name')
            ->where('rd.id', '=', $id)
            ->first();

        return view('internal/student-grading-functions/edit-score')
            ->with('data', $data);
    }
}
