<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;

class StudentRegistrationController extends Controller
{
    //

    public function index(Request $request)
    {
        $reg = DB::table('settings')->where('id', '1')->get();
        $class = DB::table('classes')->get();
        $subject = DB::table('subjects')->get();
        $pincode = DB::table('pincodes')->where('status', 'active')->get();
        return view('StudentRegistration', compact('reg', 'class', 'subject', 'pincode'));
    }

    public function register(Request $request)
    {
        $noOfstudent = $request->noOfstudent;
        $count = 1;
        $fee = DB::table('settings')->where('id', 1)->get();
        $roleCheck = DB::table('users')->where('mobile', Session()->get('mobile'))->get();
        if ($roleCheck[0]->role == "student") {
            for ($i = 1; $i <= $noOfstudent; $i++) {
                $name = $request->input('studenname' . $i);
                $gender = $request->input('gender' . $i);
                $dob = $request->input('dob' . $i);
                $dob = Carbon::parse($dob);
                $now = Carbon::now();
                $age =  $dob->diffInYears($now);
                $father = $request->input('father' . $i);
                $mother = $request->input('mother' . $i);
                $mobile = Session()->get('mobile');
                $state =  $request->input('state' . $i);
                $city = $request->input('city' . $i);
                $area = $request->input('area' . $i);
                $fulladd = $request->input('fulladd' . $i);
                $schoolname = $request->input('school' . $i);
                $medium = $request->input('medium' . $i);
                $class = $request->input('class' . $i);
                $subject = $request->input('subject' . $i);
                $pincode = $request->input('pincode' . $i);
                if ($request->file('image' . $i)) {

                    $file = $request->file('image' . $i);
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // File extension
                    $extension = $file->getClientOriginalExtension();

                    // File upload location
                    $location = 'image';
                }
                if ($request->file('aadhar' . $i)) {

                    $file1 = $request->file('aadhar' . $i);
                    $filename1 = time() . '_' . $file1->getClientOriginalName();

                    // File extension
                    $extension1 = $file1->getClientOriginalExtension();

                    // File upload location
                    $location1 = 'image';

                    // Upload file
                    if ($file1->move($location1, $filename1) && $file->move($location, $filename)) {
                        $filepath1 = 'image/' . $filename1;
                        $filepath = 'image/' . $filename;
                        $insert = DB::table('students')->insert(
                            [
                                'name' => $name,
                                'phone' => $mobile,
                                'age' => $age,
                                'pincode' => $pincode,
                                'image' => $filepath,
                                'father_name' => $father,
                                'mother_name' => $mother,
                                'gender' => $gender,
                                'dob' => $dob,
                                'school_name' => $schoolname,
                                'medium' => $medium,
                                'class' => $class,
                                'subject' => $subject,
                                'state' => $state,
                                'city' => $city,
                                'area' => $area,
                                'current_full_address' => $fulladd,
                                'aadhar' => $filepath1,

                            ]
                        );
                        if ($insert) {
                            $count = $count + 1;
                            if ($count >= $noOfstudent) {
                                Session()->put('amount', $fee[0]->work * $noOfstudent);
                                Session()->put('payment_type', 'student registration');
                                Session()->put('course_id', 'student registration');
                                return view('payment');
                            }
                        }
                    }
                }
            }
        } else if ($roleCheck[0]->role == "admin") {
            $updateUser = DB::table('users')->where('mobile', Session()->get('mobile'))->update([
                'role' => 'student'
            ]);
            if ($updateUser) {
                for ($i = 1; $i <= $noOfstudent; $i++) {
                    $name = $request->input('studenname' . $i);
                    $gender = $request->input('gender' . $i);
                    $dob = $request->input('dob' . $i);
                    $dob = Carbon::parse($dob);
                    $now = Carbon::now();
                    $age =  $dob->diffInYears($now);
                    $father = $request->input('father' . $i);
                    $mother = $request->input('mother' . $i);
                    $mobile = Session()->get('mobile');
                    $state =  $request->input('state' . $i);
                    $city = $request->input('city' . $i);
                    $area = $request->input('area' . $i);
                    $fulladd = $request->input('fulladd' . $i);
                    $schoolname = $request->input('school' . $i);
                    $medium = $request->input('medium' . $i);
                    $class = $request->input('class' . $i);
                    $subject = $request->input('subject' . $i);
                    $pincode = $request->input('pincode' . $i);
                    if ($request->file('image' . $i)) {

                        $file = $request->file('image' . $i);
                        $filename = time() . '_' . $file->getClientOriginalName();

                        // File extension
                        $extension = $file->getClientOriginalExtension();

                        // File upload location
                        $location = 'image';
                    }
                    if ($request->file('aadhar' . $i)) {

                        $file1 = $request->file('aadhar' . $i);
                        $filename1 = time() . '_' . $file1->getClientOriginalName();

                        // File extension
                        $extension1 = $file1->getClientOriginalExtension();

                        // File upload location
                        $location1 = 'image';

                        // Upload file
                        if ($file1->move($location1, $filename1) && $file->move($location, $filename)) {
                            $filepath1 = 'image/' . $filename1;
                            $filepath = 'image/' . $filename;
                            $insert = DB::table('students')->insert(
                                [
                                    'name' => $name,
                                    'phone' => $mobile,
                                    'age' => $age,
                                    'pincode' => $pincode,
                                    'image' => $filepath,
                                    'father_name' => $father,
                                    'mother_name' => $mother,
                                    'gender' => $gender,
                                    'dob' => $dob,
                                    'school_name' => $schoolname,
                                    'medium' => $medium,
                                    'class' => $class,
                                    'subject' => $subject,
                                    'state' => $state,
                                    'city' => $city,
                                    'area' => $area,
                                    'current_full_address' => $fulladd,
                                    'aadhar' => $filepath1,

                                ]
                            );
                            if ($insert) {
                                $count = $count + 1;
                                if ($count >= $noOfstudent) {
                                    Session()->put('amount', $fee[0]->work * $noOfstudent);
                                    Session()->put('payment_type', 'student registration');
                                    Session()->put('course_id', 'student registration');
                                    return view('payment');
                                }
                            }
                        }
                    }
                }
            }
        }else if ($roleCheck[0]->role == "none") {
            $updateUser = DB::table('users')->where('mobile', Session()->get('mobile'))->update([
                'role' => 'student'
            ]);
            if ($updateUser) {
                for ($i = 1; $i <= $noOfstudent; $i++) {
                    $name = $request->input('studenname' . $i);
                    $gender = $request->input('gender' . $i);
                    $dob = $request->input('dob' . $i);
                    $dob = Carbon::parse($dob);
                    $now = Carbon::now();
                    $age =  $dob->diffInYears($now);
                    $father = $request->input('father' . $i);
                    $mother = $request->input('mother' . $i);
                    $mobile = Session()->get('mobile');
                    $state =  $request->input('state' . $i);
                    $city = $request->input('city' . $i);
                    $area = $request->input('area' . $i);
                    $fulladd = $request->input('fulladd' . $i);
                    $schoolname = $request->input('school' . $i);
                    $medium = $request->input('medium' . $i);
                    $class = $request->input('class' . $i);
                    $subject = $request->input('subject' . $i);
                    $pincode = $request->input('pincode' . $i);
                    if ($request->file('image' . $i)) {

                        $file = $request->file('image' . $i);
                        $filename = time() . '_' . $file->getClientOriginalName();

                        // File extension
                        $extension = $file->getClientOriginalExtension();

                        // File upload location
                        $location = 'image';
                    }
                    if ($request->file('aadhar' . $i)) {

                        $file1 = $request->file('aadhar' . $i);
                        $filename1 = time() . '_' . $file1->getClientOriginalName();

                        // File extension
                        $extension1 = $file1->getClientOriginalExtension();

                        // File upload location
                        $location1 = 'image';

                        // Upload file
                        if ($file1->move($location1, $filename1) && $file->move($location, $filename)) {
                            $filepath1 = 'image/' . $filename1;
                            $filepath = 'image/' . $filename;
                            $insert = DB::table('students')->insert(
                                [
                                    'name' => $name,
                                    'phone' => $mobile,
                                    'age' => $age,
                                    'pincode' => $pincode,
                                    'image' => $filepath,
                                    'father_name' => $father,
                                    'mother_name' => $mother,
                                    'gender' => $gender,
                                    'dob' => $dob,
                                    'school_name' => $schoolname,
                                    'medium' => $medium,
                                    'class' => $class,
                                    'subject' => $subject,
                                    'state' => $state,
                                    'city' => $city,
                                    'area' => $area,
                                    'current_full_address' => $fulladd,
                                    'aadhar' => $filepath1,

                                ]
                            );
                            if ($insert) {
                                $count = $count + 1;
                                if ($count >= $noOfstudent) {
                                    Session()->put('amount', $fee[0]->work * $noOfstudent);
                                    Session()->put('payment_type', 'student registration');
                                    Session()->put('course_id', 'student registration');
                                    return view('payment');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
