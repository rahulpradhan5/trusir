<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use DB;

class myprofileCOntroller extends Controller
{
    public function index(Request $request)
    {
        $mobile = Session()->get('mobile');
        if (Session()->get('role') == "student") {
            $profile = DB::table('students')->where('id', Session()->get('user_id'))->get();
        } else if (Session()->get('role') == "teacher" && isset($request->id)) {
            $profile = DB::table('students')->where('id', $request->id)->get();
        } else if (Session()->get('role') == "teacher") {
            $profile = DB::table('students')->where('id', Session()->get('user_id'))->get();
        }
        $pincodes = DB::table('pincodes')->get();
        $class = DB::table('classes')->get();
        //    dd($profile);
        return view('My_Profile', compact('profile', 'pincodes', 'class'));
    }


    public function editmyprofile(Request $request)
    {
        $mobile = Session()->get('mobile');
        $id = Session()->get('user_id');
        $name = $request->name;
        $dob = $request->dob;
        $school_name = $request->school_name;
        $class = $request->class;
        $subject = $request->subject;
        //  return ([$name,$dob,$school_name,$class,$subject,$request->file('file')]);
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
                $upodate = DB::table('students')->where('id', $id)->update([
                    'name' => $name,
                    'dob' => $dob,
                    'school_name' => $school_name,
                    'class' => $class,
                    'subject' => $subject,
                    'image' => $filepath
                ]);
                return $upodate;
            } else {
                return 'failed';
            }
        } else {
            $filepath = $request->file;
            $upodate = DB::table('students')->where('id', $id)->update([
                'name' => $name,
                'dob' => $dob,
                'school_name' => $school_name,
                'class' => $class,
                'subject' => $subject,
                'image' => $filepath
            ]);
            return $upodate;
        }
    }

    public function studentPersonaledit(Request $request)
    {
        $name = $request->name;
        $f_name = $request->f_name;
        $m_name = $request->m_name;
        $gender = $request->gender;
        $dob = $request->dob;

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
                $upodate = DB::table('students')->where('id', Session()->get('user_id'))->update([
                    'name' => $name,
                    'dob' => $dob,
                    'father_name' => $f_name,
                    'mother_name' => $m_name,
                    'gender' => $gender,
                    'image' => $filepath
                ]);

                return redirect()->route('My_Profile')->with('message', 'Success');
            } else {
                return  redirect()->route('My_Profile')->with('message', 'failed');
            }
        } else {
            $getImagepath = DB::table('students')->where('id', Session()->get('user_id'))->get();
            $upodate = DB::table('students')->where('id', Session()->get('user_id'))->update([
                'name' => $name,
                'dob' => $dob,
                'father_name' => $f_name,
                'mother_name' => $m_name,
                'gender' => $gender,
                'image' => $getImagepath[0]->image
            ]);
            return redirect()->route('My_Profile')->with('message', 'Success');
        }
    }


    public function studentAddressEdit(Request $request)
    {
        $area = $request->area;
        $city = $request->city;
        $state = $request->state;
        $pincode = $request->pincode;
        $current_address = $request->current_address;
        $upodate = DB::table('students')->where('id', Session()->get('user_id'))->update([
            'area' => $area,
            'city' => $city,
            'state' => $state,
            'pincode' => $pincode,
            'current_full_address' => $current_address,
        ]);

        return redirect()->route('My_Profile')->with('message', 'Success');
    }


    public function studentstudyEdit(Request $request)
    {
        $class = $request->class;
        $medium = $request->medium;
        $school = $request->school; 
        $upodate = DB::table('students')->where('id', Session()->get('user_id'))->update([
            'class' => $class,
            'medium' => $medium,
            'school_name' => $school,
        ]);

        return redirect()->route('My_Profile')->with('message', 'Success');
    }
}
