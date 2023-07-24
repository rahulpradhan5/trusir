<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class noticeController extends Controller
{
    //

    public function index(Request $request)
    {

        if (Session()->get('role') == 'student') {
            $notice = DB::table('notice')->orderBy('id', 'desc')
                ->where(function ($query) {
                    $query->where('student_id', null)
                        ->orWhere('student_id', Session()->get('user_id'));
                })->get();
        } else if (Session()->get('role') == 'teacher') {
            $notice = DB::table('notice')->orderBy('id', 'desc')
                ->where(function ($query) {
                    $query->where('teacher_id', null)
                        ->orWhere('teacher_id', Session()->get('user_id'));
                })->get();
        }
        return view('Notice', compact('notice'));
    }

    public function addnotice(Request $request)
    {
        $id = $request->student_id;
        $insert = DB::table('notice')->insert([
            'title'=>$request->title,
            'noticedesc'=>$request->desc,
            'teacher_id'=>Session()->get('user_id'),
            'student_id'=>$id
        ]);
        if($insert){
            return  "success";
        }else{
            return  "failed";
        }
    }

    public function deleteNotice(Request $request)
    {
        $delete = DB::table('notice')->where('id',$request->id)->delete();
        if($delete){
            return "success";
        }else{
            return "failed";
        }
    }
}
