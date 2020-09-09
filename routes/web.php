<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'student'], function () {
	//TODO: DASHBOARD
	Route::get('student-dashboard','StudentDashboardController@IndexDashboard');
	Route::post('student-dashboard','StudentDashboardController@updateProfile');
});


Route::group(['prefix' => 'internal'], function () {
	//TODO: DASHBOARD
	Route::get('internal-dashboard','DashboardController@indexDashboard');
	Route::post('internal-dashboard', 'DashboardController@updateProfile');
	Route::get('legalization', 'SchoolInternalController@indexLegalization');
	Route::post('legalization', 'SchoolInternalController@updateLegalization');
});




Route::prefix('class')->group(function () {
	Route::get('/', 'classController@IndexGetClass');
	Route::get('/internal/inputclass', 'classController@tambahclass');
	Route::post('/', 'classController@storeclass');
	Route::get('//edit/{id}', 'classController@editclass');
	Route::put('//update/{id}', 'classController@updateclass');
	Route::get('//hapus/{id}', 'classController@deleteclass');
});

Route::prefix('role')->group(function () {
	Route::get('/', 'classController@IndexGetRoles');
	// Route::get('//','classController@tambahclass');
	Route::post('/', 'classController@storeRoles');
	Route::get('//edit/{id}', 'classController@editRoles');
	Route::put('//update/{id}', 'classController@updateRoles');
	Route::get('///{}', 'classController@deleteRoles');
});





Route::prefix('auth')->group(function(){
	Route::get('/login-page','SchoolInternalController@IndexLogin');
	
	Route::post('/Login','SchoolInternalController@LoginSchool');
	
	

	Route::get('/logout','SchoolInternalController@LogoutSchool');

	Route::get('/internal/input-walikelas/','SchoolInternalController@IndexWaliKelas');

	Route::post('/internal/input-walikelas/','SchoolInternalController@storeWaliKelas');

   Route::get('/internal/tambahDataWaliKelas/tambah', 'SchoolInternalController@TambahWaliKelas');
;

	Route::post('/internal/store', 'SchoolInternalController@StoreTambahWaliKelas');

	


	Route::get('/internal/EditDataWaliKelas/edit/{id}','SchoolInternalController@editWaliKelas');

	

	Route::put('/internal/update/{id}','SchoolInternalController@updateWaliKelas');

	Route::get('internal/input-walikelas/hapus/{id}','SchoolInternalController@deleteWaliKelas');

	
});



Route::prefix('student')->group(function(){
	Route::get('/LoginStudent','StudentController@IndexLoginStudent');
	Route::post('/StudentLoginPage','StudentController@LoginStudent');


	Route::get('/internal/input-student','StudentController@IndexGetSiswa');

	Route::get('/siswa/DataWaliKelas','StudentController@getDataWaliKelas');

	Route::get('/siswa/NilaiSiswa/{id}','StudentController@IndexNilaiSiswa');

	Route::get('/internal/tambahDataSiswa/tambah', 'StudentController@TambahSiswa');

	Route::post('/internal/store', 'StudentController@StoreTambahSiswa');
	
	Route::post('/internal/input-student','StudentController@storeSiswa');

	Route::get('/internal/EditDataSiswa/edit/{id}','StudentController@editSiswa');

	Route::put('/internal/update/{id}','StudentController@updateSiswa');


	Route::get('internal/input-student/hapus/{id}','StudentController@deleteSiswa');

	Route::get('/internal/DataSiswa/{class}','StudentController@DataSiswa');


   
	Route::get('/StudentLogout','StudentController@LogoutStudent');

	Route::patch('activate/{id}', 'StudentController@activateStudent');
	Route::patch('deactivate/{id}', 'StudentController@deactivateStudent');


});





Route::prefix('pelajaran')->group(function () {
	Route::post('/internal/how-to-upload','CourseController@downloadUploadGuide');

	Route::get('/internal/export-student-grade-list/{id}','CourseController@exportNilai');

	Route::get('/internal/import-grade/{id}', 'CourseController@indexImportGrade');

	Route::get('/internal/student-grade-list/{id}', 'CourseController@indexCourse');

	Route::post('/internal/student-grade-list/{id}', 'CourseController@indexCourse');

	Route::post('/internal/student-grade-list', 'CourseController@storeMataPelajaran');

	Route::post('/internal/upload-grade/{id}', 'CourseController@importStudentGrade');

	Route::put('/internal/update-score', 'CourseController@updateScore');
});


	

Route::get('/internal/student-grade-list', 'CourseController@tambahMataPelajaran');
Route::get('//edit/{id}', 'CourseController@editMataPelajaran');
Route::put('//update/{id}', 'CourseController@updateMataPelajaran');
Route::get('///{}', 'CourseController@deleteMataPelajaran');



Route::prefix('role')->group(function () {
	Route::get('/', 'classController@IndexGetRoles');
	// Route::get('//','classController@tambahclass');
	Route::post('/', 'classController@storeRoles');
	Route::get('//edit/{id}', 'classController@editRoles');
	Route::put('//update/{id}', 'classController@updateRoles');
	Route::get('///{}', 'classController@deleteRoles');
});




Route::prefix('password')->group(function(){

	Route::get('/change-password','ChangePasswordController@editChangePassword');
	Route::patch('/update-password-student','ChangePasswordController@updatePasswordStudent');
	Route::patch('/update-password-school-internal','ChangePasswordController@updatePasswordSchoolInternal');

});


//Route Forgot Password School Internal
//PUNYA GW (TTD AUL)
Route::get('/forgot-password/{type}', 'ForgotPasswordController@forgot');
Route::post('/change-password/{type}', 'ChangePasswordController@sendPasswordEmail');

//BUKAN GUA
Route::post('/forgot_password', 'ForgotPasswordController@password');

//Route Forgot Password Student
Route::get('/forgot_password_student', 'ForgotPasswordController@forgotStudent');
Route::post('/forgot_password_student', 'ForgotPasswordController@passwordStudent');







Route::post('reset_password_wihout_token',
	'ForgotPasswordController@validatePasswordRequest');
Route::post('reset_password_with_token','ForgotPasswordController@resetPassword');

Route::get('/', function () {
	return redirect('/auth/login-page');
});

//Gw pusing baca routenya. Gw bikin buat school-internal ya 
Route::prefix('school-internal')->group(function(){
	Route::patch('activate/{id}', 'SchoolInternalController@activateSchoolInternal');
	Route::patch('deactivate/{id}', 'SchoolInternalController@deactivateSchoolInternal');
});

Route::prefix('class-management')->group(function(){
	Route::get('', 'ClassManagementController@getPage');	
	Route::get('/detail/{id}', 'ClassManagementController@getClassById');	

	Route::post('', 'ClassManagementController@createClass');
	Route::post('/assign-student', 'ClassManagementController@assignStudentToClass');
	Route::post('/assign-school-internal', 'ClassManagementController@assignSchoolInternalToClass');
	Route::post('/mapping-course', 'ClassManagementController@createMappingCourse');
	
	Route::delete('/mapping-course/delete', 'ClassManagementController@deleteMappingCourse');

	Route::patch('/deactivate/school-internal/{id}', 'ClassManagementController@deactivateSchoolInternal');
	Route::patch('/deactivate/student/{id}', 'ClassManagementController@deactivateStudent');
	Route::patch('/deactivate/class/{id}', 'ClassManagementController@deactivateClass');
	Route::post('/change-semester/{id}', 'ClassManagementController@changeSemester');	
	
});

Route::prefix('course-management')->group(function(){
	Route::get('', 'CourseController@getCourseManagementPage');
	Route::patch('/{id}', 'CourseController@deleteCourse');
	Route::put('/', 'CourseController@updateCourse');

	Route::post('/create', 'CourseController@createCourse');
});

//Per AJAX-an gw taro sini ya anjeng. 
Route::prefix('ajax')->group(function(){
	//School Internal Management
	Route::get('get-school-internal/{id}', 'ModalAjaxController@getSchoolInternalById');
	Route::get('get-school-internal-activate/{id}', 'ModalAjaxController@getActivateSchoolInternalModal');
	Route::get('get-school-internal-deactivate/{id}', 'ModalAjaxController@getDeactivateSchoolInternalModal');

	//Student Management
	Route::get('get-student/{id}', 'ModalAjaxController@getStudentById');
	Route::get('get-student-activate/{id}', 'ModalAjaxController@getActivateStudentModal');
	Route::get('get-student-deactivate/{id}', 'ModalAjaxController@getDeactivateStudentModal');

	//Class Management
	Route::get('get-class-deactivate-modal/{id}', 'ModalAjaxController@getDeactivateClassModal');
	Route::get('get-class-deactivate-school-internal/{id}', 'ModalAjaxController@getDeactivateClassSchoolInternal');
	Route::get('get-class-deactivate-student/{id}', 'ModalAjaxController@getDeactivateClassStudent');
	Route::get('get-class-course-mapping/{id}', 'ModalAjaxController@getClassCourseMapping');

	//Course Management
	Route::get('get-course-edit-modal/{id}', 'ModalAjaxController@getCourseEditModal');
	Route::get('get-course-delete-modal/{id}', 'ModalAjaxController@getCourseDeleteModal');

	//Score Management
	Route::get('get-score-edit-modal/{id}', 'ModalAjaxController@getScoreEditModal');
});

