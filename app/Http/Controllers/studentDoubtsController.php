<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use DB;

class studentDoubtsController extends Controller
{
    //
    public function index(Request $request)
    {
        if(Session()->get('role') == "teacher"){

            $id = $request->id;
        }else if(Session()->get('role') == "student"){

            $id = Session()->get('user_id');
        }
       $teacher = DB::table('teacher_assign')->where('student_id',$id)->join('teachers','teachers.id','teacher_assign.teacher_id')->get();
       $doubts = DB::table('student_doubts')->where('student_id',$id)->get();
       
        return view('Student_doubt', ["teacher" => $teacher,'doubts'=>$doubts]);
    }

    public function uploaddoubt(Request $request)
    {
        $id = Session()->get('user_id');
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File extension
            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = 'image/pdf';

            // Upload file
            if ($file->move($location, $filename)) {
                $filepath = 'image/pdf/' . $filename;
                $uploadfile = DB::table('student_doubts')->insert([
                    'file' => $filepath,
                    'student_id' => $id,
                    'teacher_id'=>$request->teacher_id,
                    'tittle'=>$request->title,
                    'desc'=>$request->desc
                ]);
                if($uploadfile){
                    return "success";
                }else{
                    return "failed";
                }
            } else {
                return "failed";
            }
        }
    }

    public function yourDoubts(Request $request)
    {
       
        $id = Session()->get('user_id');
        $doubts = DB::table('student_doubts')->where('student_id', $id)->orderBy('id', 'desc')->get();
        return view('Your_Doubts', ['doubts' => $doubts]);
    }
}
