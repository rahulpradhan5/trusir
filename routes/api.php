<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/studentHome', [api::class,'studentHome']);
Route::post('/studentEnquiry', [api::class,'studentEnquiry']);
Route::post('/teacherEnquiry', [api::class,'teacherEnquiry']);
Route::post('/registerCheck', [api::class,'registerCheck']);
Route::post('/studentRegister', [api::class,'studentRegister']);
Route::post('/teacherRegister', [api::class,'teacherRegister']);
Route::get('/studentProfiles', [api::class,'studentProfiles']);
Route::get('/perticularstudentProfile', [api::class,'perticularstudentProfile']);
Route::post('/editStudent', [api::class,'editStudent']);
Route::get('/courses', [api::class,'courses']);
Route::get('/coursesDelete', [api::class,'coursesDelete']);
Route::get('/teacherAssign', [api::class,'teacherAssign']);
Route::get('/teacherProfile', [api::class,'teacherProfile']);
Route::get('/gk', [api::class,'gk']);
Route::post('/addGk',[api::class,'addGk']);
Route::get('/teacherLogin',[api::class,'teacherLogin']);
Route::get('/studentList', [api::class,'studnetList']);
Route::post('/editTeacherProfile', [api::class,'editTeacherProfile']);
Route::get('/studentnotice', [api::class,'studentnotice']);
Route::get('/teachernotice', [api::class,'teachernotice']);
Route::get('/addnotice', [api::class,'addnotice']);
Route::post('/parantsDoubt', [api::class,'parantsDoubt']);
Route::get('/parantsDoubtshow', [api::class,'parantsDoubtshow']);
Route::post('/addstudentDoubt', [api::class,'addstudentDoubt']);
Route::get('/studentDoubt', [api::class,'studentDoubt']);
Route::get('/studentAttandence', [api::class,'studentAttandence']);
Route::get('/testSeriese', [api::class,'testSeriese']);
Route::post('/contactUs', [api::class,'contactUs']);
Route::get('/payment',[api::class,'payment']);
Route::get('/demoCourse',[api::class,'demoCourse']);
Route::post('/progressReportpost',[api::class,'progressReportpost']);
Route::get('/teacherTestShow',[api::class,'tecaherTestShow']);
Route::get('/teacherAttandence',[api::class,'teacherAttandence']);
Route::get('/teacherAbsent',[api::class,'teacherAbsent']);
Route::get('/studentAbsent',[api::class,'studentAbsent']);
Route::get('/feeCalculation',[api::class,'feeCalculation']);
Route::get('/progressReport',[api::class,'progressReport']);
Route::post('/uploadTest',[api::class,'uploadTest']);
Route::get('CourseTests',[api::class,'CourseTests']);
Route::get('/login', [api::class,'login']);
Route::get('/testShow', [api::class,'testShow']);
