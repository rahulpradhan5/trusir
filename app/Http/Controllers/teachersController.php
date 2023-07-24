<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Contracts\Session\Session;

class teachersController extends Controller
{

    public function index(Request $req)
    {
        if (Session()->get('role') == "student") {
            $teachers = DB::table('teacher_assign')->where('student_id', Session()->get('user_id'))->join("teachers", 'teachers.id', 'teacher_assign.teacher_id')->get();
            return view('Teacher_Profile', ['teachers' => $teachers]);
        } else {
            $teachers = DB::table('teacher_assign')->where('teacher_id', Session()->get('user_id'))->join("students", 'students.id', 'teacher_assign.student_id')->join('course_purchased','course_purchased.user_id','teacher_assign.student_id')->join('course','course_purchased.course_id','course.id')
            ->select('teacher_assign.dt','teacher_assign.student_id as id','students.name','students.image','course_purchased.type','course.subject','students.class')->get();
            return view('Teacher_Profile', ['teachers' => $teachers]);
        }
    }
    public function editTeacher(Request $req)
    {
        $id = $req->id;
        $teachers = DB::table('teachers')->where('id', $id)->get();
        $pincodes = DB::table('pincodes')->get();
        $class = DB::table('classes')->get();
        return view('EditTeacher_Profile', ['teachers' => $teachers,'pincodes'=>$pincodes,'class'=>$class]);
    }

    public function editProfileteacher(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $age = $request->age;
        $quali = $request->quali;
        $exp = $request->exp;
        $skill = $request->skill;
        $medium = $request->medium;
        // return ([$id,$name,$age,$quali,$exp,$skill,$medium,$request->file]);
        if ($request->file('file')) {

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File extension
            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = 'image';

            // Upload file
            if ($file->move($location, $filename)) {
                $filepath = 'image/' . $filename;
                $upodate = DB::table('teachers')->where('id', $id)->update([
                    'name' => $name,
                    'qulification' => $quali,
                    'age' => $age,
                    'exp' => $exp,
                    'subject' => $skill,
                    'medium' => $medium,
                    'image' => $filepath
                ]);
                return $upodate;
            } else {
                return 'failed';
            }
        } else {
            $filepath = $request->file;
            $upodate = DB::table('teachers')->where('id', $id)->update([
                'name' => $name,
                'qulification' => $quali,
                'age' => $age,
                'exp' => $exp,
                'subject' => $skill,
                'medium' => $medium,
                'image' => $filepath
            ]);
            return $upodate;
        }
    }
}
