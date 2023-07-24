<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Contracts\Session\Session as SessionSession;

class parentsdoubtsController extends Controller
{
    public function index(Request $request)
    {
        $mobile = Session()->get('mobile');
       
        $id = Session()->get('user_id');
        $doubts = DB::table('parents_doubts')->where('student_id', $id)->orderBy('id', 'desc')->get();
        return view('ParentsDoubt', ['doubts' => $doubts]);
    }

    public function ParentDoubt(Request $request)
    {
        $mobile = Session()->get('mobile');
        return view('ParentDoubt', ['mobile' => $mobile]);
    }

    public function doubt(Request $request)
    {
       
        $id = Session()->get('user_id');
        $email = $request->email;
        $title = $request->title;
        $disc = $request->disc;
        $filepath1="";
        if ($request->file('aadhar1')) {

            $file1 = $request->file('aadhar1');
            $filename1 = time() . '_' . $file1->getClientOriginalName();

            // File extension
            $extension1 = $file1->getClientOriginalExtension();

            // File upload location
            $location1 = 'image';

            // Upload file
            if ($file1->move($location1, $filename1)) {
                $filepath1 = 'image/' . $filename1;
            }
        }
        $uploadDoubt = DB::table('parents_doubts')->insert([
            'email' => $email,
            'title' => $title,
            'disc' => $disc,
            'student_id'=>$id,
            'file'=>$filepath1
        ]);
        if ($uploadDoubt) {
           return view('ParentDoubt',['message'=>'success']);
        } else {
            return view('ParentDoubt',['message'=>'failed']);
        }
    }
}
