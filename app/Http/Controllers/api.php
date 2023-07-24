<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Google\Cloud\Storage\Connection\Rest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class api extends Controller
{
    //student home and registation inputs

    public function studentHome(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $mobile = $request->mobile;
            if ($mobile == "" || !isset($mobile)) {
                return response()->json([
                    'Message' => 'mobile no require'
                ], 500);
            } else {
                $userAllowed = DB::table('users')->where('mobile', $mobile)->get();
                if ($userAllowed->count() > 0) {
                    if ($userAllowed[0]->isAvalable == 'yes') {
                        $classes = DB::table('classes')->get();
                        $subjects = DB::table('subjects')->get();
                        $setting = DB::table('settings')->where('id', '1')->get();
                        $testimonials = DB::table('testimonial')->orderBy('id', 'desc')->get();
                        $apphomesliders = DB::table('apphomesliders')->orderBy('id', 'desc')->get();
                        $studentEnq = DB::table('student_enquary')->where('mobile', $mobile)->get();
                        if ($studentEnq->count() > 0) {
                            $studentEnquery = 'yes';
                        } else {
                            $studentEnquery = 'no';
                        }
                        $locations = DB::table('location')->get();
                        return response()->json([
                            'classes' => $classes,
                            'subjects' => $subjects,
                            'testimonials' => $testimonials,
                            'apphomesliders' => $apphomesliders,
                            'city' => $locations,
                            'fee' => $setting[0]->work,
                            'StudentEnq' => $studentEnquery,
                            'Message' => 'Success'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Trusher not available for your location'
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'Message' => 'user not found'
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Authkey not set or invalid auth key'
            ], 500);
        }
    }
    //student enquiry
    public function studentEnquiry(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_name = $request->student_name;
            $class = $request->class;
            $city = $request->city;
            $pincode = $request->pincode;
            $mobile = $request->mobile;
            $pincodeCheck = DB::table('pincodes')->where('pincode', $pincode)->where('status', 'active')->get();
            if ($pincodeCheck->count() > 0) {
                $insertEnq = DB::table('student_enquary')->insert([
                    'student_name' => $student_name,
                    'class' => $class,
                    'city' => $city,
                    'pincode' => $pincode,
                    'mobile' => $mobile
                ]);
                if ($insertEnq) {
                    $roleChange = DB::table('users')->where('mobile', $mobile)->update([
                        'role' => 'student',
                    ]);
                    if ($roleChange) {
                        return response()->json([
                            'Message' => 'Success'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Failed'
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'Message' => 'Failed'
                    ], 200);
                }
            } else {
                return response()->json([
                    'Message' => 'Your area not available'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Authkey not set or invalid auth key'
            ], 500);
        }
    }


    //login
    public function login(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $mobile = $request->mobile;
            $loginCheck = DB::table('users')->where('mobile', $mobile)->get();
            if ($loginCheck->count() > 0) {
                return response()->json([
                    'logindata' => $loginCheck,
                    'Message' => 'Success'
                ], 200);
            } else {
                $insertLogin = DB::table('users')->insert([
                    'mobile' => $mobile,
                    'otp' => rand(1000, 9999),
                    'verify' => 'yes',
                ]);
                if ($insertLogin) {
                    $loginCheck = DB::table('users')->where('mobile', $mobile)->get();
                    return response()->json([
                        'logindata' => $loginCheck,
                        'Message' => 'Success'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Login failed'
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Authkey not set or invalid auth key'
            ], 500);
        }
    }
    //teacher enquiry
    public function teacherEnquiry(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_name = $request->teacher_name;
            $gender = $request->gender;
            $qualification = $request->qualification;
            $city = $request->city;
            $pincode = $request->pincode;
            $mobile = $request->mobile;
            $pincodeCheck = DB::table('pincodes')->where('pincode', $pincode)->where('status', 'active')->get();
            if ($pincodeCheck->count() > 0) {
                $insertEnq = DB::table('teacher_enquiry')->insert([
                    'teacher_name' => $student_name,
                    'gender' => $gender,
                    'qualification' => $qualification,
                    'city' => $city,
                    'class'=>$request->class,
                    'pincode' => $pincode,
                    'mobile' => $mobile
                ]);
                if ($insertEnq) {
                    $roleChange = DB::table('users')->where('mobile', $mobile)->update([
                        'role' => 'teacher',
                    ]);
                    if ($roleChange) {
                        return response()->json([
                            'Message' => 'Success'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Failed'
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'Message' => 'Failed'
                    ], 200);
                }
            } else {
                return response()->json([
                    'Message' => 'Your area not available'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Authkey not set or invalid auth key'
            ], 500);
        }
    }
    //Register check;

    public function registerCheck(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $role  = $request->role;
            $mobile = $request->mobile;
            if ($role == 'student') {
                $check = DB::table('students')->where('phone', $mobile)->get();
                if ($check->count() > 0) {
                    if ($check[0]->paid == 'yes') {
                        return response()->json([
                            'Message' => 'Student Registerd'
                        ], 200);
                    } else {
                        $fee = DB::table('settings')->where('id', 1)->get();
                        $amount = $check->count() * $fee[0]->work;
                        return response()->json([
                            'Message' => 'Paymnet not done yert',
                            'Amount' => $amount
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'Message' => 'Student not Registerd'
                    ], 200);
                }
            } else if ($role == 'teacher') {
                $check = DB::table('teachers')->where('phone', $mobile)->get();
                if ($check->count() > 0) {
                    if ($check[0]->paid == 'yes') {

                        return response()->json([
                            'Message' => 'Teacher Registerd'
                        ], 200);
                    } else {
                        $fee = DB::table('settings')->where('id', 1)->get();
                        $amount = $fee[0]->work;
                        return response()->json([
                            'Message' => 'Paymnet not done yert',
                            'Amount' => $amount
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'Message' => 'Teacher not Registerd'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // studentRegister


    public function studentRegister(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $noOfstudent = $request->noOfstudent;
            $count = 1;
            $fee = DB::table('settings')->where('id', 1)->get();
            for ($i = 1; $i <= $noOfstudent; $i++) {
                $name = $request->input('studenname' . $i);
                $gender = $request->input('gender' . $i);
                $dob = $request->input('dob' . $i);
                $dob = Carbon::parse($dob);
                $now = Carbon::now();
                $age =  $dob->diffInYears($now);
                $father = $request->input('father' . $i);
                $mother = $request->input('mother' . $i);
                $mobile =  $request->mobile;
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
                                // Session()->put('amount', $fee[0]->work * $noOfstudent);
                                // Session()->put('payment_type', 'student registration');
                                // Session()->put('course_id', 'student registration');
                                // return view('payment');
                                return response()->json([
                                    'message' => 'Registrtion successfull'
                                ], 200);
                            }
                        } else {
                            return response()->json([
                                'message' => 'Something wents wrong'
                            ], 200);
                        }
                    }
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // studentRegister


    public function teacherRegister(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $fee = DB::table('settings')->where('id', 1)->get();
            $name = $request->input('teachername');
            $gender = $request->input('gender');
            $dob = $request->input('dob');
            $dob = Carbon::parse($dob);
            $now = Carbon::now();
            $age =  $dob->diffInYears($now);
            $father = $request->input('father');
            $mother = $request->input('mother');
            $mobile = $request->mobile;
            $state =  $request->input('state');
            $city = $request->input('city');
            $area = $request->input('area');
            $fulladd = $request->input('fulladd');
            $exp = $request->exp;
            $quali = $request->qualification;
            $medium = $request->input('medium');
            $class = $request->input('class');
            $subject = $request->input('subject');
            $pincode = $request->input('pincode');
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
            }
            if ($request->file('aadhar')) {

                $file1 = $request->file('aadhar');
                $filename1 = time() . '_' . $file1->getClientOriginalName();

                // File extension
                $extension1 = $file1->getClientOriginalExtension();

                // File upload location
                $location1 = 'image';

                // Upload file
                if ($file1->move($location1, $filename1) && $file->move($location, $filename)) {
                    $filepath1 = 'image/' . $filename1;
                    $filepath = 'image/' . $filename;
                    $insert = DB::table('teachers')->insert(
                        [
                            'name' => $name,
                            'phone' => $mobile,
                            'age' => $age,
                            'pincode' => $pincode,
                            'image' => $filepath,
                            'qulification' => $quali,
                            'exp' => $exp,
                            'father_name' => $father,
                            'mother_name' => $mother,
                            'gender' => $gender,
                            'dob' => $dob,
                            'medium' => $medium,
                            'preferd_class' => $class,
                            'subject' => $subject,
                            'state' => $state,
                            'city' => $city,
                            'area' => $area,
                            'current_full_address' => $fulladd,
                            'aadhar' => $filepath1,

                        ]
                    );
                    if ($insert) {
                        return response()->json([
                            'message' => 'Registrtion successfull'
                        ], 200);
                    }
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // payment

    public function payment(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $paymentType = $request->payment_type;
            $mobile = $request->mobile;
            $payment_id = $request->payment_id;
            $status = $request->status;
            $amount = $request->amount;
            $insert = DB::table('transaction')->insert([
                'mobile' => $mobile,
                'transaction_id' => $payment_id,
                'status' => $status,
                'amount' => $amount,
                'type' =>  $paymentType,
            ]);
            if ($insert) {
                if ($paymentType == "student registration") {
                    $userUpdate = DB::table('students')->where('phone', $mobile)->update([
                        'paid' => 'yes'
                    ]);
                    if ($userUpdate) {
                        return response()->json([
                            'Message' => 'Add successfully '
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Already registerd '
                        ], 200);
                    }
                } else if ($paymentType == "Add course") {
                    $user_id = $request->user_id;
                    $courseid = $request->courseid;
                    $currentDate = Carbon::now();
                    // Add 5 days to the current date
                    $futureDate = $currentDate->addDays(30);
                    // Display the future date
                    $enddate = $futureDate->toDateString();
                    $demoCheck = DB::table('course_purchased')->where('user_id', $user_id)->where('course_id', $courseid)->where('type', 'demo')->get();
                    if ($demoCheck->count() > 0) {
                        $userUpdate = DB::table('course_purchased')->where('id', $demoCheck[0]->id)->update([
                            'type' => 'purchased',
                            'end_date' => $enddate,
                            'renew_date' => $enddate
                        ]);
                        if ($userUpdate) {
                            return response()->json([
                                'Message' => 'Add successfully '
                            ], 200);
                        } else {
                            return response()->json([
                                'Message' => 'Course  registerd '
                            ], 200);
                        }
                    } else {
                        $userUpdate = DB::table('course_purchased')->insert([
                            'course_id' => $courseid,
                            'user_id' => $user_id,
                            'type' => 'purchased',
                            'end_date' => $enddate,
                            'renew_date' => $enddate
                        ]);
                        if ($userUpdate) {
                            return response()->json([
                                'Message' => 'Add successfully '
                            ], 200);
                        } else {
                            return response()->json([
                                'Message' => 'Add Failed '
                            ], 200);
                        }
                    }
                } else if ($paymentType == "teacher registration") {
                    $userUpdate = DB::table('teachers')->where('phone', $mobile)->update([
                        'paid' => 'yes'
                    ]);
                    if ($userUpdate) {
                        return response()->json([
                            'Message' => 'Add successfully '
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Already registerd '
                        ], 200);
                    }
                } else if ($paymentType == "renew course") {
                    $user_id = $request->user_id;
                    $courseid = $request->courseid;
                    $currentDate = Carbon::now();
                    // Add 5 days to the current date
                    $futureDate = $currentDate->addDays(30);
                    // Display the future date
                    $enddate = $futureDate->toDateString();
                    $userUpdate = DB::table('course_purchased')->where('course_id', $courseid)->where('user_id',$user_id)->update([
                        'type' => 'purchased',
                        'end_date' => $futureDate,
                        'renew_date' => $currentDate
                    ]);
                    if ($userUpdate) {
                        return response()->json([
                            'Message' => 'Course renewed successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Course renewed failed'
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'Message' => 'Something wents wrong'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // sudent profile
    public function studentProfiles(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $mobile = $request->mobile;
            $profile = DB::table("students")->where('phone', $mobile)->get();
            return response()->json([
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // perticular studnet Profile

    public function perticularstudentProfile(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $user_id = $request->user_id;
            $profile = DB::table('students')->where('id', $user_id)->get();
            return response()->json([
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // edit student
    public function editStudent(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_name = $request->student_name;
            $dob = $request->dob;
            $school_name = $request->school_name;
            $class = $request->class;
            $user_id = $request->user_id;
            $subject = $request->subject;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                }
            } else {
                $filepath = $request->image;
            }

            $update = DB::table('studnets')->where('id', $user_id)->update([
                'name' => $student_name,
                'dob' => $dob,
                'school_name' => $school_name,
                'class' => $class,
                'subject' => $subject,
                'image' => $filepath
            ]);
            if ($update) {
                $users = DB::table('studnets')->where('user_id', $user_id)->get();
                return response()->json([
                    'data' => $users,
                    'Message' => 'Update successfully'
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'Update failed'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // courses
    public function courses(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $user_id = $request->user_id;
            $class = $request->class;
            $medium = $request->medium;
            $courses = DB::table('course')->where('medium', $medium)->where('class', $class)->get();
            $mycourse = DB::table('course_purchased')->where('course_purchased.user_id', $user_id)->leftjoin('course', 'course.id', 'course_purchased.course_id')->get();
            return response()->json([
                'data' => $courses,
                'mycourse' => $mycourse
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // delete course

    public function coursesDelete(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $id = $request->course_id;
            $user_id = $request->user_id;
            $delete = DB::table('course_purchased')->where('course_id', $id)->where('user_id', $user_id)->delete();
            if ($delete) {
                return response()->json([
                    'Message' => 'Deleted successfully '
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'course deletion failed ,try again!'
                ], 200);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // teacher assign
    public function teacherAssign(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $data = DB::table('teacher_assign')->where('student_id', $student_id)->leftjoin('teachers', 'teachers.id', 'teacher_assign.teacher_id')->get();
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // teacherProfile

    public function teacherProfile(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $teacherData = DB::table('teachers')->where('id', $teacher_id)->get();
            return response()->json([
                'data' => $teacherData
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // gk
    public function gk(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            if(isset($request->student_id)){
            $user_id = $request->student_id;
            $allgk = DB::table('gk')->where('student_id', null)->get();
            $forYou = DB::table('gk')->where('student_id', $user_id)->get();
            }else if(isset($request->teacher_id)){
                 $user_id = $request->teacher_id;
            $allgk = DB::table('gk')->where('teacher_id', null)->get();
            $forYou = DB::table('gk')->where('teacher_id', $user_id)->get();
            }
            return response()->json([
                'allgk' => $allgk,
                'foryou' => $forYou
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // student list for teacher
    public function studnetList(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $studnetData = DB::table('teacher_assign')->where("teacher_assign.teacher_id", $teacher_id)
                ->leftjoin('students', 'students.id', 'teacher_assign.student_id')
                ->leftjoin('course_purchased', 'course_purchased.user_id', 'teacher_assign.student_id')
                ->leftjoin('course', 'course.id', 'teacher_assign.course_id')
                ->select('teacher_assign.*', 'students.*', 'course_purchased.*', 'course.*')
                ->get();
            return response()->json([
                'data' => $studnetData
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // addgk

    public function addGk(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $title = $request->title;
            $disc = $request->discription;
            $category = $request->category;
            $student_id = $request->student_id;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                    $insert = DB::table('gk')->insert([
                        'tittle' => $title,
                        'disc' => $disc,
                        'image' => $filepath,
                        'category' => $category,
                        'student_id' => $student_id,
                        'teacher_id' => $teacher_id
                    ]);
                    if ($insert) {
                        return response()->json([
                            'Message' => 'Gk added successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Gk added failed'
                        ], 200);
                    }
                }
            } else {
                $insert = DB::table('gk')->insert([
                    'tittle' => $title,
                    'disc' => $disc,
                    'category' => $category,
                    'student_id' => $student_id,
                    'teacher_id' => $teacher_id
                ]);
                if ($insert) {
                    return response()->json([
                        'Message' => 'Gk added successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Gk added failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // teacherLogin

    public function teacherLogin(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $mobile = $request->mobile;
            $teacherData = DB::table('teachers')->where('phone', $mobile)->get();
            return response()->json([
                'data' => $teacherData
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // editTeacherProfile

    public function editTeacherProfile(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $name = $request->teacher_name;
            $dob = $request->dob;
            $class = $request->class;
            $medium = $request->medium;
            $subject = $request->subject;
            $address = $request->address;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                    $insert = DB::table('teachers')->where("id", $teacher_id)->update([
                        'name' => $name,
                        'dob' => $dob,
                        'medium' => $medium,
                        'preferd_class' => $class,
                        'subject' => $subject,
                        'current_full_address' => $address,
                        'image' => $filepath
                    ]);
                    if ($insert) {
                        return response()->json([
                            'Message' => 'Teacher Updated successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Teacher Updation failed'
                        ], 200);
                    }
                }
            } else {
                $filepath = $request->image;
                $insert = DB::table('teachers')->where("id", $teacher_id)->update([
                    'name' => $name,
                    'dob' => $dob,
                    'medium' => $medium,
                    'preferd_class' => $class,
                    'subject' => $subject,
                    'current_full_address' => $address,
                    'image' => $filepath
                ]);
                if ($insert) {
                    return response()->json([
                        'Message' => 'Teacher Updated successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Teacher Updation failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // studnet notice

    public function studentnotice(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            if (isset($request->student_id)) {
            $data = DB::table('notice')->orderBy('id', 'desc')
                ->where(function ($query) use ($request) {
                    $query->where('student_id', null)
                        ->orWhere('student_id', $request->student_id);
                })->get();
        } else if (isset($request->teacher_id)) {
            $data = DB::table('notice')->orderBy('id', 'desc')
                ->where(function ($query) use ($request) {
                    $query->where('teacher_id', null)
                        ->orWhere('teacher_id', $request->teacher_id);
                })->get();
        }
           
            return response()->json([
                'data' => $data,
               
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // addnotice

    public function addnotice(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $title = $request->title;
            $noticedesc = $request->discription;
            $student_id = $request->student_id;
            $teacher_id = $request->teacher_id;
            $insert = DB::table('notice')->insert([
                'title' => $title,
                'noticedesc' => $noticedesc,
                'student_id' => $student_id,
                'teacher_id' => $teacher_id
            ]);
            if ($insert) {
                return response()->json([
                    'Message' => 'Notice added successfully'
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'Notice added failed'
                ], 200);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // parant doubts
    public function parantsDoubt(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $email = $request->email;
            $title = $request->title;
            $disc = $request->disc;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                    $insert = DB::table('parents_doubts')->insert([
                        'student_id' => $student_id,
                        'email' => $email,
                        'title' => $title,
                        'disc' => $disc,
                        'file' => $filepath,
                    ]);
                    if ($insert) {
                        return response()->json([
                            'Message' => 'Doubt sent successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Doubt sent failed'
                        ], 200);
                    }
                }
            } else {
                $insert = DB::table('parents_doubts')->insert([
                    'student_id' => $student_id,
                    'email' => $email,
                    'title' => $title,
                    'disc' => $disc,
                ]);
                if ($insert) {
                    return response()->json([
                        'Message' => 'Doubt sent successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Doubt sent failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // addstudentDoubts

    public function addstudentDoubt(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $student_id = $request->student_id;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                     $insert = DB::table('student_doubts')->insert([
                    'file' => $filepath,
                    'student_id' => $student_id,
                    'teacher_id'=>$teacher_id,
                    'tittle'=>$request->title,
                    'desc'=>$request->desc
                ]);
                    if ($insert) {
                        return response()->json([
                            'Message' => 'Doubt sent successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Doubt sent failed'
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'Message' => 'File required'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // studentDoubt

    public function studentDoubt(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $student_id = $request->student_id;
            $data = DB::table('student_doubts')->where('teacher_id', $teacher_id)->where('student_id', $student_id)->get();
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // studentAttandence

    public function studentAttandence(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $attendance = [];
            $course = DB::table("teacher_assign")->where('student_id', $student_id)->join('course', 'course.id', 'teacher_assign.course_id')->get();
            foreach ($course as $courses) {
                $attandence = DB::table('attendence')->where('course_id', $courses->course_id)->where('student_id', $student_id)->get();
                $attendance[$courses->course_name] = $attandence;
            }
            return response()->json([
                'data' => $attendance
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // testSeriese

    public function testSeriese(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $currentDate = Carbon::now()->format('Y-m-d');
            $upload = [];
            $test =  DB::table('course_purchased')
                ->join('course', 'course_purchased.course_id', '=', 'course.id')
                ->join('teacher_assign', 'teacher_assign.course_id', '=', 'course_purchased.course_id')
                ->where('teacher_assign.student_id', $student_id)
                ->join('test_seriese', 'test_seriese.course_id', '=', 'course_purchased.course_id')
                ->where('course_purchased.user_id', $student_id)
                ->where('test_seriese.shadule_date', '>=', $currentDate)
                ->whereNotExists(function ($query) use ($student_id) {
                    $query->select(DB::raw(1))
                        ->from('test_upload')
                        ->whereRaw('test_upload.student_id != ' . $student_id)
                        ->whereRaw('test_upload.test_id = test_seriese.id');
                })
                ->orderBy('test_seriese.shadule_date') // Order by the ID column (or any other suitable column)
                ->select('course_purchased.*', 'teacher_assign.*', 'course.*', 'test_seriese.*', 'test_seriese.id as test_id')
                ->get();
            if ($test->count() > 0) {
                $upload = DB::table('test_upload')->where('test_id', $test[0]->id)->where('student_id', $student_id)->get();
            }
            return response()->json([
                'data' => $test,
                'uploaded' => $upload
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // contactUs
    public function contactUs(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $save = DB::table('contact')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
            if ($save) {
                $data = [
                    'title' => 'Test Email',
                    'name' => $request->name,
                    'email' => $request->email,
                    'content' => $request->message,
                ];

                $mail =  Mail::send('mail', $data, function ($message) {
                    $message->to('pbaijayanti1@gmail.com', 'Recipient Name')
                        ->subject('Test Email');
                    $message->from('trusher@gmail.com', 'Trusher');
                });

                return response()->json([
                    'Message' => 'Success'
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'failed'
                ], 200);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // parantsDoubtshow
    public function parantsDoubtshow(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $id = $request->studnet_id;
            $doubts = DB::table('parents_doubts')->where('student_id', $id)->orderBy('id', 'desc')->get();
            return response()->json([
                'data' => $doubts
            ], 500);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }
    // demoCourse
    public function demoCourse(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $id = $request->course_id;
            $student_id = $request->student_id;
            $currentDate = Carbon::now();
            // Add 5 days to the current date
            $futureDate = $currentDate->addDays(5);
            // Display the future date
            $enddate = $futureDate->toDateString();
            $checkdemo = DB::table('course_purchased')->where('course_id', $id)->where('user_id', Session()->get('user_id'))->get();
            if ($checkdemo->count() > 0) {
                return response()->json([
                    'Message' => 'You are already request for demo'
                ], 200);
            } else {
                $enroll = DB::table('course_purchased')->insert([
                    'course_id' => $id,
                    'user_id' => $student_id,
                    'end_date' => $enddate,
                    'type' => 'demo'
                ]);
                if ($enroll) {
                    return response()->json([
                        'Message' => 'The demo request successfully sumited, teacher will assign you soon!'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // uploadTest

    public function uploadTest(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            
            if ($request->hasfile('questions')) {
                // Get the uploaded files
                $questionfiles = $request->file('questions');
    
                // Create a unique filename for the zip archive
                $zipFilename = time() . rand(0000, 9999) . '_archive.zip';
    
                // Create a zip archive
                $zip = new ZipArchive;
                $zipPath = public_path('uploads/' . $zipFilename);
    
                if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
                    foreach ($questionfiles as $file) {
                        // Create a unique filename for each uploaded file
                        $filename = time() . '_' . $file->getClientOriginalName();
    
                        // Save the file to the storage location
                        $file->move(public_path('uploads'), $filename);
    
                        // Add the file to the zip archive
                        $zip->addFile(public_path('uploads/' . $filename), $filename);
                    }
    
                    $zip->close();
    
                    // Save the zip file path to the database
                    // Assuming you have a model called File and a 'zip_path' column
    
    
                }
            }

        if ($request->hasfile('answers')) {
            $answersfiles = $request->file('answers');
            // Create a unique filename for the zip archive
            $zipFilename1 = time() . rand(0000, 9999) . '_archive.zip';
            $zip = new ZipArchive;
            $zipPath1 = public_path('uploads/' . $zipFilename1);
            if ($zip->open($zipPath1, ZipArchive::CREATE) === true) {
                foreach ($answersfiles as $file) {
                    // Create a unique filename for each uploaded file
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Save the file to the storage location
                    $file->move(public_path('uploads'), $filename);

                    // Add the file to the zip archive
                    $zip->addFile(public_path('uploads/' . $filename), $filename);
                }

                $zip->close();
                
            }
        }
        
        if (isset($request->teacher_id) && issset($request->student_id)) {
            $course = DB::table('teacher_assign')->where('teacher_id', $request->teacher_id)->where('student_id', $request->student_id,)->get();
            $uploadTest = DB::table('test_upload')->insert([
                'title' => $request->title,
                'student_id' => $request->student_id,
                'teacher_id' =>  $request->teacher_id,
                'course_id' => $course[0]->course_id,
                'questions' => 'uploads/' . $zipFilename,
                'answer' => 'uploads/' . $zipFilename1,
            ]);
            if ($uploadTest) {
               return response()->json([
                    'Message' => 'Success'
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'Failed'
                ], 500);
            }
        } else if (isset($request->student_id) && !isset($request->teacher_id)) {
            $course = DB::table('teacher_assign')->where('course_id', $request->course)->where('student_id', $request->student_id)->get();
           
            $uploadTest = DB::table('test_upload')->insert([
                'title' => $request->title,
                'student_id' => $request->student_id,
                'teacher_id' => $course[0]->teacher_id,
                'course_id' => $request->course,
                'questions' => 'uploads/' . $zipFilename,
                'answer' => 'uploads/' . $zipFilename1,
            ]);
            if ($uploadTest) {
               return response()->json([
                    'Message' => 'Success'
                ], 200);
            } else {
                return response()->json([
                    'Message' => 'Failed'
                ], 500);
            }
        }
    
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // progressReport
    public function progressReport(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $data = DB::table('progress_report')->where('progress_report.student_id', $student_id)
                ->orderBy('progress_report.id', 'desc')
                ->leftjoin('course', 'course.id', 'progress_report.course_id')->get();
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // CourseTests
    public function CourseTests(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $test = [];
            $data  = DB::table('teacher_assign')
                ->select('course_id')
                ->where('teacher_id', 4)
                ->distinct()
                ->get();

            $students = DB::table('teacher_assign')->where('teacher_id', $teacher_id)->leftjoin('students', 'students.id', 'teacher_assign.student_id')->get();
            foreach ($data as $datas) {
                $tests = DB::table('test_seriese')->where('course_id', $datas->course_id)->orderBy('id', 'desc')->get();
            }
            return response()->json([
                'students' => $students,
                'test' => $tests
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    // progressReportpost
    public function progressReportpost(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $testId = $request->test_id;
            $teacher_id = $request->teacher_id;
            $total_marks = $request->totalMarks;
            $getMarks = $request->obtainMarks;
            if ($request->file('image')) {

                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
                if ($file->move($location, $filename)) {

                    $filepath = 'image/' . $filename;
                    $insert = DB::table('progress_report')->insert([
                        'student_id' => $student_id,
                        'test_id' => $testId,
                        'teacher_id' => $teacher_id,
                        'total_marks' => $total_marks,
                        'obtain_marks' => $getMarks,
                        'file' => $filepath,
                    ]);
                    if ($insert) {
                        return response()->json([
                            'Message' => 'Report add successfully'
                        ], 200);
                    } else {
                        return response()->json([
                            'Message' => 'Report add failed'
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'Message' => 'File required'
                ], 500);
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // tecaherTestShow
    public function tecaherTestShow(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $teacher_id = $request->teacher_id;
            $data = DB::table('test_upload')
                ->where('test_upload.teacher_id', $teacher_id)
                ->where('test_upload.student_id', $student_id)
                ->orderBy('test_upload.id', 'desc')
                ->get();
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set'
            ], 500);
        }
    }


    // teacherAttandence

    public function teacherAttandence(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $teacher_id = $request->teacher_id;
            $student_id = $request->student_id;
            $attendance = [];
            $course = DB::table("teacher_assign")->where('teacher_assign.teacher_id', $teacher_id)->where('teacher_assign.student_id', $student_id)->join('course', 'course.id', 'teacher_assign.course_id')->get();
            foreach ($course as $courses) {
                $attandence = DB::table('attendence')->where('course_id', $courses->course_id)->where('teacher_id', $teacher_id)->where('student_id', $student_id)->get();
                $attendance[$courses->course_name] = $attandence;
            }
            return response()->json([
                'data' => $attendance
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }

    //   teacherAbsent
    public function teacherAbsent(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $teacher_id = $request->teacher_id;
            $course_id = $request->course_id;
            $currentDate = Carbon::today()->toDateString();
            $attandacecheck =  DB::table('attendence')
                ->where('teacher_id', $teacher_id)
                ->where('student_id', $student_id)
                ->whereDate('dt', '=', $currentDate)
                ->get();
            if ($attandacecheck->count() > 0) {
                $attandace = DB::table('attendence')
                    ->whereDate('dt', $currentDate) // Check dt field in Y-m-d format
                    ->where('teacher_id', $teacher_id) // Replace $teacher_id with the desired teacher ID
                    ->where('student_id', $student_id) // Replace $student_id with the desired student ID
                    ->update(['techer_attend' => 'no']);
                if ($attandace) {
                    return response()->json([
                        'Message' => 'Updation successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Updation Failed'
                    ], 200);
                }
            } else {
                $attandace = DB::table("attendence")->insert([
                    'techer_attend' => 'no',
                    'student_id' => $student_id,
                    'teacher_id' => $teacher_id,
                    'course_id' => $course_id
                ]);
                if ($attandace) {
                    return response()->json([
                        'Message' => 'Updation successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Updation Failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // studentAbsent
    public function studentAbsent(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $student_id = $request->student_id;
            $teacher_id = $request->teacher_id;
            $course_id = $request->course_id;
            $currentDate = Carbon::today()->toDateString();
            $attandacecheck =  DB::table('attendence')
                ->where('teacher_id', $teacher_id)
                ->where('student_id', $student_id)
                ->whereDate('dt', '=', $currentDate)
                ->get();
            if ($attandacecheck->count() > 0) {
                $attandace = DB::table('attendence')
                    ->whereDate('dt', $currentDate) // Check dt field in Y-m-d format
                    ->where('teacher_id', $teacher_id) // Replace $teacher_id with the desired teacher ID
                    ->where('student_id', $student_id) // Replace $student_id with the desired student ID
                    ->update(['student_attend' => 'no']);
                if ($attandace) {
                    return response()->json([
                        'Message' => 'Updation successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Updation Failed'
                    ], 200);
                }
            } else {
                $attandace = DB::table("attendence")->insert([
                    'student_attend' => 'no',
                    'student_id' => $student_id,
                    'teacher_id' => $teacher_id,
                    'course_id' => $course_id
                ]);
                if ($attandace) {
                    return response()->json([
                        'Message' => 'Updation successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'Message' => 'Updation Failed'
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }


    // fee calculation
    public function feeCalculation(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
            $fees = [];
            $student_id = $request->student_id;
            $feeCalculation = DB::table('course_purchased')->where('user_id', $student_id)->join('course', 'course.id', 'course_purchased.course_id')->join('teacher_assign', 'teacher_assign.course_id', 'course_purchased.course_id')->where('teacher_assign.student_id', $student_id)->get();

            foreach ($feeCalculation as $caluclate) {
                $data = DB::table('attendence')->where('teacher_id', $caluclate->teacher_id)->where('student_id', $student_id)->where('techer_attend', 'yes')->where('student_attend', 'yes')->whereDate('dt', '>', $caluclate->renew_date)->get();
                $fees[$caluclate->course_name] = $caluclate->price / 30 * $data->count();
            }
            return response()->json([
                'data' => $fees
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }
    
      // test show
    public function testShow(Request $request)
    {
        if ($request->authKey == env('API_AUTH_KEY')) {
              if (isset($request->student_id)) {
            $course = DB::table('course_purchased')->where('user_id', $request->student_id)->join('course','course.id','course_purchased.course_id')->get();
            $test = DB::table('test_upload')->where('student_id', $request->student_id)->leftjoin('course', 'course.id', 'test_upload.course_id')->orderBy('test_upload.id', 'desc')->select('test_upload.*', 'course.course_name')->get();
        } else if (isset($request->teacher_id) && isset($request->student_id)) {
            $student_id = $request->student_id;
            $course = DB::table('teacher_assign')->where('student_id', $student_id)->where('teacher_id', $request->teacher_id)->get();
            $test = DB::table('test_upload')->where('test_upload.student_id', $student_id)->where('test_upload.teacher_id', $request->teacher_id)->leftjoin('course', 'course.id', 'test_upload.course_id')->orderBy('test_upload.id', 'desc')->select('test_upload.*', 'course.course_name')->get();
        }
         return response()->json([
                'test' => $test,
                'course'=>$course
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Auth key not set '
            ], 500);
        }
    }
}
