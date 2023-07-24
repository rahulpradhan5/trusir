<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class progressController extends Controller
{
    //

    public function index(Request $request)
    {
        if (Session()->get('role') == "teacher") {
            $student_id = $request->id;
            $progress = DB::table('progress_report')->where('student_id', $student_id)->where('teacher_id', Session()->get('user_id'))->leftjoin('course','course.id','progress_report.course_id')->orderBy('progress_report.id', 'desc')->get();
           
        }else if(Session()->get('role') == "student"){
            $progress = DB::table('progress_report')->where('student_id', Session()->get('user_id'))->leftjoin('course','course.id','progress_report.course_id')->orderBy('progress_report.id', 'desc')->get();
        }
        return view('progress', compact('progress'));
    }
}
