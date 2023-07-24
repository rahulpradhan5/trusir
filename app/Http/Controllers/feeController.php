<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class feeController extends Controller
{
    //

    public function index()
    {
        $fees = [];
        $attandance = [];
        $student_id = Session()->get('user_id');
        $feeCalculation = DB::table('course_purchased')->where('user_id', $student_id)->join('course', 'course.id', 'course_purchased.course_id')->join('teacher_assign', 'teacher_assign.course_id', 'course_purchased.course_id')->where('teacher_assign.student_id', $student_id)->get();
       
        foreach ($feeCalculation as $caluclate) {
            $data = DB::table('attendence')->where('teacher_id', $caluclate->teacher_id)->where('student_id', $student_id)->where('techer_attend', 'yes')->where('student_attend', 'yes')->whereDate('dt', '>', $caluclate->renew_date)->get();
            $fees[$caluclate->course_name]['price'] = $caluclate->price / 30 * $data->count();
            $attandance = DB::table('attendence')->where('teacher_id', $caluclate->teacher_id)->where('student_id', $student_id)->whereDate('dt', '>', $caluclate->renew_date)->get();
            $fees[$caluclate->course_name]['attandance'] = $attandance;
           
        }
        
        return view('feeCalculation',compact('fees'));
    }
}
