<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class studentController extends Controller
{
    //

    public function StudentFacilities(Request $request)
    {
        if (Session()->get('role') == 'student') {
            $profile = DB::table('students')->where('id', Session()->get('user_id'))->get();
            $purchased = DB::table("course_purchased")->where('user_id', Session()->get('user_id'))->get();
            if ($purchased->count() > 0) {
                $purchas = 'yes';
                return view('StudentFacilities', compact('profile', 'purchas'));
            } else {
                $purchas = 'no';
                return view('StudentFacilities', compact('profile', 'purchas'));
            }
        } else if (Session()->get('role') == 'teacher') {
            if (isset($request->id)) {
                $profile = DB::table('students')->where('id', Session()->get('user_id'))->get();
                return view('StudentFacilities', compact('profile', 'purchas'));
            } else {
                $profile = DB::table('teachers')->where('id', Session()->get('user_id'))->get();
                return view('StudentFacilities', compact('profile'));
            }
        }
    }
}
