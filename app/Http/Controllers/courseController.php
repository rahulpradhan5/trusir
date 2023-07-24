<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class courseController extends Controller
{
    //

    public function courses(Request $request)
    {
        $userdata = DB::table('students')->where('id', Session()->get('user_id'))->get();
        $courses = DB::table('course')->where('medium', $userdata[0]->medium)->where('class', $userdata[0]->class)->get();
        $mycourse = DB::table('course_purchased')->where('course_purchased.user_id', Session()->get('user_id'))->join('course', 'course.id', 'course_purchased.course_id')->get();
        // First array with subarrays
        // Convert arrays to Laravel Collections
        // Convert arrays to Laravel Collections
        $collection1 = new Collection($courses);
        $collection2 = new Collection($mycourse);

        // Extract the IDs from the second collection
        $array2Ids = $collection2->pluck('id')->all();

        // Filter out objects from the first collection that have matching IDs
        $courses = $collection1->reject(function ($obj) use ($array2Ids) {
            return in_array($obj->id, $array2Ids);
        })->all();
        return view('courses', compact('courses', 'mycourse'));
    }

    public function takeDemo(Request $request)
    {
        $id = $request->id;
        $currentDate = Carbon::now();
        // Add 5 days to the current date
        $futureDate = $currentDate->addDays(5);
        // Display the future date
        $enddate = $futureDate->toDateString();
        $checkdemo = DB::table('course_purchased')->where('course_id', $id)->where('user_id', Session()->get('user_id'))->get();
        if ($checkdemo->count() > 0) {
            return "You are already request for demo";
        } else {
            $enroll = DB::table('course_purchased')->insert([
                'course_id' => $id,
                'user_id' => Session()->get('user_id'),
                'end_date' => $enddate,
                'type' => 'demo'
            ]);
            if ($enroll) {
                return "The demo request successfully sumited, teacher will assign you soon!";
            } else {
                return "Failed";
            }
        }
    }


    public function makeCoursePaymet(Request $request)
    {
        $paymet = DB::table('course')->where('id', $request->id)->get();
        $checkPurchase = DB::table('course_purchased')->where('user_id', Session()->get('user_id'))->where('course_id', $request->id)->where('type', 'purchased')->get();
        if ($checkPurchase->count() > 0) {
            return redirect()->route('courses');
        } else {
            Session()->put('amount', $paymet[0]->price);
            Session()->put('payment_type', 'Add course');
            Session()->put('course_id',  $request->id);
            return view('/payment');
        }
    }

    public function couseDelete(Request $request)
    {
        $id = $request->id;
        $delete = DB::table('course_delete')->insert([
            'course_id'=>$id,
            'student_id'=>Session()->get('user_id')
        ]);
        if ($delete) {
            return "success";
        } else {
            return "course deletion failed ,try again!";
        }
    }
}
