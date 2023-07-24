<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class attendanceController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Session()->get('role') == 'teacher') {
            $student_id = $request->id;
            $currentDate = Carbon::now();
            $month = $currentDate->month;
            $year = $currentDate->year;
            $attendance = [];
            $course = DB::table("teacher_assign")->where('student_id', $student_id)->where('teacher_id', Session()->get('user_id'))->join('course', 'course.id', 'teacher_assign.course_id')->get();
            foreach ($course as $courses) {
                $attandence = DB::table('attendence')->where('course_id', $courses->course_id)->where('student_id', $student_id)->whereMonth('dt', $month)
                    ->whereYear('dt', $year)->get();
                $attendance[$courses->course_name] = $attandence;
            }
        } else if (Session()->get('role') == 'student') {
            $currentDate = Carbon::now();
            $month = $currentDate->month;
            $year = $currentDate->year;
            $attendance = [];
            $course = DB::table("teacher_assign")->where('student_id', Session()->get('user_id'))->join('course', 'course.id', 'teacher_assign.course_id')->get();
            foreach ($course as $courses) {
                $attandence = DB::table('attendence')->where('course_id', $courses->course_id)->where('student_id', Session()->get('user_id'))->whereMonth('dt', $month)
                    ->whereYear('dt', $year)->get();
                $attendance[$courses->course_name] = $attandence;
            }
        }

        return view('Attendance', compact('attendance'));
    }


    public function loadMonthdata(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $attendance = [];
        $course = DB::table("teacher_assign")->where('student_id', $request->id)->join('course', 'course.id', 'teacher_assign.course_id')->get();
        foreach ($course as $courses) {
            $attandence = DB::table('attendence')->where('course_id', $courses->course_id)->where('student_id', $request->id)->whereMonth('dt', $month)
                ->whereYear('dt', $year)->get();
            $attendance[$courses->course_name] = $attandence;
        }
        // dd($attendance);
        // $attendanceData = DB::table('course_purchased')->where('course_purchased.user_id', Session()->get('user_id'))->join('attendence', 'attendence.student_id', 'course_purchased.user_id')->get();
        // $courses = DB::table('course_purchased')->where('user_id', Session()->get('user_id'))->join('course', 'course.id', 'course_purchased.course_id')->where('course_purchased.type', 'purchased')->get();
        return $attendance;
    }
}
