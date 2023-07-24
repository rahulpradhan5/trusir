<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use Nexmo\Laravel\Facade\Nexmo;
use App\Http\Controllers\contactusController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\teachersController;
use App\Http\Controllers\myprofileCOntroller;
use App\Http\Controllers\studentDoubtsController;
use App\Http\Controllers\parentsdoubtsController;
use App\Http\Controllers\gkController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\logout;
use App\Http\Controllers\studentController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\teacherRegisterController;
use App\Http\Controllers\attendanceController;
use App\Http\Controllers\testCntroller;
use App\Http\Controllers\noticeController;
use  App\Http\Controllers\adminindexController;
use  App\Http\Controllers\adminCoursecontroller;
use  App\Http\Controllers\adminStudentController;
use App\Http\Controllers\adminGkcontroller;
use App\Http\Controllers\adminTeacherController;
use App\Http\Controllers\progressController;
use App\Http\Controllers\adminsettingcontroller;
use App\Http\Controllers\adminTestimonialcontroller; 
use App\Http\Controllers\feeController; 


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


Route::get('Login', [loginController::class, 'index'])->name('Login');
Route::get('count', [loginController::class, 'count'])->name('count');
Route::get('otp', [loginController::class, 'sendOtp'])->name('otp');
Route::get('Otp', function () {
    return view('Otp');
});
Route::get('otp_send', [loginController::class, 'sendOtp'])->name('otp_send');
Route::get('verifYotp', [loginController::class, 'verifYotp'])->name('verifYotp');
Route::get('/', [indexController::class, 'index'])->name('/');
Route::group(['middleware' => 'check_mobile_session'], function () {

    Route::get('mail', [contactusController::class, 'contact'])->name('mail');
    Route::get('student_enq', [indexController::class, 'student_enq'])->name('student_enq');
    Route::get('send_otp', [indexController::class, 'sendOtp'])->name('send_otp');
    Route::get('teacher_enq', [indexController::class, 'teacher_enq'])->name('teacher_enq');
    Route::get('My_Profile', [myprofileCOntroller::class, 'index'])->name('My_Profile');
    Route::post('studentPersonaledit', [myprofileCOntroller::class, 'studentPersonaledit'])->name('studentPersonaledit');
    Route::post('studentAddressEdit', [myprofileCOntroller::class, 'studentAddressEdit'])->name('studentAddressEdit');
    Route::post('studentstudyEdit', [myprofileCOntroller::class, 'studentstudyEdit'])->name('studentstudyEdit');
    Route::group(['middleware' => 'courseCheck'], function () {
        Route::get('Teacher_Profile', [teachersController::class, 'index'])->name('Teacher_Profile');
        Route::get('EditTeacher_Profile', [teachersController::class, 'editTeacher'])->name('EditTeacher_Profile');
        Route::post('editProfileteacher', [teachersController::class, 'editProfileteacher'])->name('editProfileteacher');
        Route::post('editmyprofile', [myprofileCOntroller::class, 'editmyprofile'])->name('editmyprofile');
        Route::get('Student_doubt', [studentDoubtsController::class, 'index'])->name('Student_doubt');
        Route::post('uploaddoubt', [studentDoubtsController::class, 'uploaddoubt'])->name('uploaddoubt');
        Route::get('Student_doubt', [studentDoubtsController::class, 'index'])->name('Student_doubt');
        Route::get('ParentsDoubt', [parentsdoubtsController::class, 'index'])->name('ParentsDoubt');
        Route::get('ParentDoubt', [parentsdoubtsController::class, 'ParentDoubt'])->name('ParentDoubt');
        Route::post('doubt', [parentsdoubtsController::class, 'doubt'])->name('doubt');
        Route::get('Your_Doubts', [studentDoubtsController::class, 'yourDoubts'])->name('Your_Doubts');
        Route::get('ChangeNumber', [loginController::class, 'ChangeNumber'])->name('ChangeNumber');
        Route::get('NumberChange', [loginController::class, 'NumberChange'])->name('NumberChange');
        Route::get('changeOtp', [loginController::class, 'changeOtp'])->name('changeOtp');
        // student controller
        Route::get('StudentFacilities', [studentController::class, 'StudentFacilities']);
        // attandance
        Route::get('Attendance', [attendanceController::class, 'index']);
        Route::get('loadMonthdata', [attendanceController::class, 'loadMonthdata']);

        Route::get('Fee_Payment', function () {
            return view('Fee_Payment');
        });
        // tests
        Route::get('Testseries', [testCntroller::class, 'index'])->name('Testseries');
        Route::post('testUpload', [testCntroller::class, 'testUpload']);
        Route::get('progress', [progressController::class, 'index']);
    


        // gk
        Route::get('General_Knowledge', [gkController::class, 'index'])->name('General_Knowledge');
        Route::get('gkCateload', [gkController::class, 'gkCateload']);
        Route::get('deleteGK', [gkController::class, 'deleteGK']);
        Route::post('addGk', [gkController::class, 'addGk'])->name('addGk');
        Route::get('Notice', [noticeController::class, 'index']);
        Route::get('deleteNotice', [noticeController::class, 'deleteNotice']);
        Route::post('addnotice', [noticeController::class, 'addnotice']);
    });
    Route::get('logout', [logout::class, 'logout'])->name('logout');
    Route::get('setlogin', [loginController::class, 'setlogin']);

    // courses
    Route::get('courses', [courseController::class, 'courses'])->name('courses');
    Route::get('takeDemo', [courseController::class, 'takeDemo']);
    Route::get('makeCoursePaymet', [courseController::class, 'makeCoursePaymet']);
    Route::get('couseDelete', [courseController::class, 'couseDelete'])->name('couseDelete');



    Route::get('Contact_us', function () {
        return view('Contact_us');
    });
    Route::get('Logout', function () {
        return view('Logout');
    });
    Route::get('StudentRegistration', [StudentRegistrationController::class, 'index']);
    Route::post('StudentSubmit', [StudentRegistrationController::class, 'register']);
    // payment
    Route::post('payment', [paymentController::class, 'payment']);
    Route::get('/priceCheck', [paymentController::class, 'priceCheck']);
    // techers
    Route::get('teacherRegistration', [teacherRegisterController::class, 'index']);
    Route::post('teacherSubmit', [teacherRegisterController::class, 'register']);
    Route::get('cityload', [teacherRegisterController::class, 'cityload']);
    Route::get('pincodeload', [teacherRegisterController::class, 'pincodeload']);


    // admin
    Route::get('/admin', [adminindexController::class, 'index'])->name('admin');
    Route::get('/admin/index', [adminindexController::class, 'index']);

    // class
    Route::get('/admin/class', [adminindexController::class, 'class']);
    Route::get('/admin/classdelete', [adminindexController::class, 'classdelete']);

     // class
     Route::get('/admin/subjects', [adminindexController::class, 'subjects']);
     Route::get('/admin/subjectsdelete', [adminindexController::class, 'subjectsdelete']);
    

    // course
    Route::get('/admin/course', [adminCoursecontroller::class, 'index']);
    Route::get('/admin/add-course', [adminCoursecontroller::class, 'addCourse']);
    Route::get('/admin/add-subject', [adminCoursecontroller::class, 'addSubject']);
    Route::get('/admin/add-class', [adminCoursecontroller::class, 'addClass']);
    Route::post('/admin/addedCourse', [adminCoursecontroller::class, 'addedCourse']);
    Route::post('/admin/editaddedCourse', [adminCoursecontroller::class, 'editaddedCourse']);
    Route::get('/admin/deletecourse', [adminCoursecontroller::class, 'deleteCourse']);
    Route::get('/admin/load-subject', [adminCoursecontroller::class, 'loadSubject']);
    Route::get('/admin/load-class', [adminCoursecontroller::class, 'loadClass']);
    Route::get('/admin/edit-course', [adminCoursecontroller::class, 'editCourse']);
    // pincodes
    Route::get('/admin/pincodes', [adminindexController::class, 'pincodes']);
    Route::get('/admin/add-pincode', [adminindexController::class, 'addpincodes']);
    Route::get('/admin/addedPincode', [adminindexController::class, 'addedpincode']);
    Route::get('/admin/edit-pincode', [adminindexController::class, 'editpincode']);
    Route::get('/admin/editededPincode', [adminindexController::class, 'editededPincode']);
    Route::get('/admin/deletepin', [adminindexController::class, 'deletepin']);
    // student
    Route::get('/admin/students', [adminStudentController::class, 'index']);
    Route::get('/admin/student_enq', [adminStudentController::class, 'studentEnq']);
    Route::get('/admin/view-student', [adminStudentController::class, 'viewStudent'])->name('/admin/view-student');
    Route::get('/admin/edit-student', [adminStudentController::class, 'editStudent']);
    Route::post('/admin/editedstudent', [adminStudentController::class, 'editedstudent']);
    Route::get('/admin/deletestudent', [adminStudentController::class, 'deletestudent']);
    Route::get('/admin/deletedeleteteacherassign', [adminStudentController::class, 'deletedeleteteacherassign']);
    Route::get('/admin/deletetest', [adminStudentController::class, 'deletetest']);
    Route::get('/admin/deleteprogress', [adminStudentController::class, 'deleteprogress']);
    Route::get('/admin/purchase-course', [adminStudentController::class, 'purchaseCourse']);
    Route::post('/admin/givecourse', [adminStudentController::class, 'givecourse']);
    Route::get('/admin/deletecoursepurchased', [adminStudentController::class, 'deletecoursepurchased']);
    Route::get('/admin/add-progress', [adminStudentController::class, 'addProgress']);
    Route::post('admin/progressadd', [adminStudentController::class, 'progressadd']);
    Route::get('admin/assign', [adminStudentController::class, 'assign']);
    Route::get('admin/loadslot', [adminStudentController::class, 'loadslot']);
    Route::post('admin/assignteacher', [adminStudentController::class, 'assignteacher']);
    Route::get('admin/searchstudent', [adminStudentController::class, 'searchstudent']);
    Route::get('/admin/studentdelete', [adminStudentController::class, 'studentdelete']);
    // teachers
    Route::get('/admin/teachers', [adminTeacherController::class, 'index']);
    Route::get('/admin/teachers_enq', [adminTeacherController::class, 'teachersEnq']);
    Route::get('/admin/view-teacher', [adminTeacherController::class, 'viewteacher']);
    Route::get('/admin/delete-student', [adminTeacherController::class, 'deletestudent']);
    Route::get('/admin/delete-teacher', [adminTeacherController::class, 'deleteteacher']);
    Route::get('/admin/searchteacher', [adminTeacherController::class, 'searchteacher']);
    // gk
    Route::get('/admin/gk', [adminGkcontroller::class, 'index']);
    Route::get('/admin/add-gk', [adminGkcontroller::class, 'addgk']);
    Route::post('/admin/addedgk', [adminGkcontroller::class, 'addedgk']);
    Route::get('/admin/deletegk', [adminGkcontroller::class, 'deleteGk']);

    // purchase
    Route::get('/admin/coursepurchased', [adminCoursecontroller::class, 'coursepurchased']);
   Route::get('/admin/course_delete', [adminCoursecontroller::class, 'coursedeletepage']);
   Route::get('/admin/course_delete_accept', [adminCoursecontroller::class, 'coursedeleteaccept']);
   Route::get('/admin/acceptreject', [adminCoursecontroller::class, 'acceptreject']);
    // transaction history
    Route::get('/admin/transactionhistrory', [adminCoursecontroller::class, 'transactionhistrory']);
    // settings
    Route::get('/admin/settings', [adminsettingcontroller::class, 'index']);
    Route::get('/admin/registrationpriceupdate', [adminsettingcontroller::class, 'registrationpriceupdate']);
    Route::post('/admin/addslider', [adminsettingcontroller::class, 'addslider']);
    Route::post('/admin/addholiday', [adminsettingcontroller::class, 'addholiday']);
    Route::get('/admin/deleteslider', [adminsettingcontroller::class, 'deleteslider']);
    Route::get('/admin/deleteholiday', [adminsettingcontroller::class, 'deleteholiday']);
    // testimonials
    Route::get('/admin/testimonials', [adminTestimonialcontroller::class, 'index']);
    Route::get('/admin/testidelete', [adminTestimonialcontroller::class, 'testidelete']);
    Route::get('/admin/testistatus', [adminTestimonialcontroller::class, 'testistatus']);
    Route::get('/admin/edittsesti', [adminTestimonialcontroller::class, 'edittsesti']);
    Route::post('/admin/testimonailedit', [adminTestimonialcontroller::class, 'testimonailedit']);
    
    // fee calculations
    Route::get('feeCalculation', [feeController::class, 'index']);
    
});
