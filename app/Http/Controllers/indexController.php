<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use DB;
use Session;

class indexController extends Controller
{
    public function index(Request $req)
    {
        $classes = DB::table('classes')->get();
        $subjects = DB::table('subjects')->get();
        $locations = DB::table('location')->get();
        $testimonial = DB::table('testimonial')->where('status', 'yes')->orderBy('id', 'desc')->limit(3)->get();
        $bannerslider = DB::table('apphomesliders')->where('type', 'home')->orderBy('id', 'desc')->get();
        if (Session()->get('role') == 'none') {
            return view('welcome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
        } else if (Session()->get('role') == 'admin') {
            return redirect()->route('admin');
        } else if (Session()->get('role') == 'student') {

            if (Session()->get('role') == 'student' && Session()->has('user_id')) {
                $paymentCheck = DB::table('students')->where('phone', Session()->get('mobile'))->where("paid", "no")->get();
                if ($paymentCheck->count() > 0) {
                    $fee = DB::table('settings')->where('id', 1)->get();
                    Session()->put('amount', $fee[0]->work * $paymentCheck->count());
                    Session()->put('payment_type', "student registration");
                    return view('payment');
                } else {
                    return view('studentHome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
                }
            } else if (Session()->get('role') == 'student') {
                $profiles = DB::table('students')->where('phone', Session()->get('mobile'))->get();
                if ($profiles->count() > 0) {
                    Session()->get('isStudent', 'true');
                    return view('profile_select', compact('profiles'));
                } else {
                    return view('studentHome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
                }
            }
        } else if (Session()->get('role') == 'teacher') {
            $teacherCheck = DB::table('teachers')->where('phone', Session()->get('mobile'))->get();
            if ($teacherCheck->count() > 0) {
                if ($teacherCheck[0]->paid == 'yes') {
                    Session()->put('user_id', $teacherCheck[0]->id);
                    return view('teacherHome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
                } else {
                    $fee = DB::table('settings')->where('id', 1)->get();
                    Session()->put('amount', $fee[0]->work);
                    Session()->put('payment_type', "teacher registration");
                    return view('payment');
                }
            } else {
                return view('teacherHome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
            }
        } else {
            return view('welcome', ['bannerslider' => $bannerslider, 'subjects' => $subjects, 'classes' => $classes, 'location' => $locations, 'testimonial' => $testimonial]);
        }
    }

    public function student_enq(Request $req)
    {
        $name = $req->name;
        $class = $req->se_class;
        $city = $req->city;
        $pincode = $req->pincode;
        $mobile = Session()->get('mobile');

        $insertData = DB::table('student_enquary')->insert([
            'student_name' => $name,
            'class' => $class,
            'city' => $city,
            'pincode' => $pincode,
            'mobile' => $mobile
        ]);
        if ($insertData) {

            return "success";
        } else {
            return "failed";
        }
    }
    public function teacher_enq(Request $req)
    {
        $name = $req->name;
        $class = $req->te_quali;
        $city = $req->city;
        $pincode = $req->pincode;
        $gender = $req->gen;
        $mobile = Session()->get('mobile');
        $insertData = DB::table('teacher_enquiry')->insert([
            'teacher_name' => $name,
            'gender' => $gender,
            'qualification' => $class,
            'city' => $city,
            'class'=>$req->class,
            'pincode' => $pincode,
            'mobile' => $mobile
        ]);
        if ($insertData) {

            return "success";
        } else {
            return "failedin";
        }
    }

    public function sendOtp(Request $req)
    {
        $number = $req->number;
        $otp = mt_rand(1000, 9999);
        $saveOtp = DB::table('otp')->where("mobile", $number)->orderBy('id', 'desc')->limit(1)->get();
        if (count($saveOtp) > 0) {
            $save = DB::table('otp')->where("mobile", $number)->update([
                'otp' => $otp,
            ]);
            if ($save) {
                $sent = $this->otp($number, $otp);
                if ($sent == "success") {
                    return "success";
                } else {
                    return "Failed";
                }
            } else {
                return "Failed";
            }
        } else {
            $save = DB::table('otp')->where("mobile", $number)->insert([
                'mobile' => $number,
                'otp' => $otp,
            ]);
            if ($save) {
                $sent = $this->otp($number, $otp);
                if ($sent == "success") {
                    return "success";
                } else {
                    return "Failed";
                }
            } else {
                return "Failed";
            }
        }
    }
    private function otp($number, $otp)
    {
        Nexmo::message()->send([
            'to'   => '+91' . $number,
            'from' => '+916377039527',
            'text' => 'Your Login Otp is ' . $otp . ' For verification',
        ]);
        return "success";
    }
}
