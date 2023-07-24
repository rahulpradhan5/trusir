<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nexmo\Laravel\Facade\Nexmo;
use DB;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class loginController extends Controller
{
    public function index()
    {

        return view('Login');
    }

    public function sendOtp(Request $request)
    {
        $timeIntervalHours = 0;
        $number = $request->input('number');
        $verificationId = $request->input('result');
        $usercheck = DB::table('users')->where('mobile', $number)->get();

        // Calculate the time interval in seconds

        if ($usercheck->count() > 0) {
            if ($usercheck[0]->otpSentTime != '00:00:00') {
                $savedTime = $usercheck[0]->otpSentTime;

                // Get the current time
                $currentTime = date('H:i:s');
                $timeIntervalSeconds = strtotime($currentTime) - strtotime($savedTime);
                // Convert the time interval from seconds to hours
                $timeIntervalHours = $timeIntervalSeconds / 3600;

                // Round the result to 2 decimal places
                $timeIntervalHours = round($timeIntervalHours, 2);
            }
            if ($usercheck[0]->otpSentTime == '00:00:00') {
                return view('Otp', ['message' => 'Otp Sent', 'mobile' => $number, 'result' => $verificationId, 'count' => $usercheck[0]->count]);
            } else if ($timeIntervalHours >= 24) {
                $userTimeUpdate = DB::table('users')->where('mobile', $number)->update([
                    'count' => 0,
                    'otpSentTime' => '00:00:00'
                ]);

                return view('Otp', ['message' => 'Otp Sent', 'mobile' => $number, 'result' => $verificationId, 'count' => $usercheck[0]->count]);
            } else {
                return view('Login', ['message' => 'Your login limit exceeded', 'mobile' => $number, 'result' => $verificationId, 'count' => $usercheck[0]->count]);
            }
        } else {
            $insertUser = DB::table('users')->insert([
                'mobile' => $number,
                'otp' => rand(1000, 9999),
            ]);
            if ($insertUser) {
                $count = DB::table('users')->where('mobile', $number)->get();
                return view('Otp', ['message' => 'Otp Sent', 'mobile' => $number, 'result' => $verificationId, 'count' => $count[0]->count]);
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
    }

    public function count(Request $request)
    {
        $count = $request->count;
        $number = $request->number;
        if ($count >= 3) {
            $update = DB::table('users')->where('mobile', $number)->update(
                [
                    'count' => $count,
                    'otpSentTime' => date('h:i:s')
                ]
            );
        } else {
            $update = DB::table('users')->where('mobile', $number)->update(
                [
                    'count' => $count,
                ]
            );
        }
    }

    public function verifYotp(Request $req)
    {

        $number = $req->mobile;

        $otpCheck = DB::table('users')->where('mobile', $number)->get();
        if ($otpCheck[0]->verify == 'yes') {
            Session()->put('mobile', $number);
            Session()->put('role', $otpCheck[0]->role);
            return 'success';
        } else {
            $update = DB::table('users')->where('mobile', $number)->update([
                'verify' => 'yes',
                'otp' => '0',
            ]);
            if ($update) {
                Session()->put('mobile', $number);
                Session()->put('role', $otpCheck[0]->role);
                return 'success';
            } else {
                return 'Failed update';
            }
        }
    }

    public function ChangeNumber(Request $request)
    {
        return view('ChangeNumber');
    }
    public function NumberChange(Request $request)
    {
        $oldMobile = Session()->get('mobile');
        $number = $request->input('number');
        $otp = mt_rand(1000, 9999);
        $save = DB::table('users')->where('mobile', $oldMobile)->update([
            'otp' => $otp,
        ]);
        if ($save) {
            // $this->otp($number, $otp);
            return "success";
        } else {
            return "failed";
        }
    }

    public function changeOtp(Request $request)
    {
        $oldMobile = Session()->get('mobile');
        $number = $request->number;
        $otp = $request->otp;
        $otpTake = DB::table('users')->where('mobile', $oldMobile)->get();
        $realotp = $otpTake[0]->otp;
        if ($realotp == $otp) {
            $updateNum = DB::table('users')->where('mobile', $oldMobile)->update(['mobile' => $number, 'otp' => 0]);
            if ($updateNum) {
                Session()->put('mobile', $number);
                return "success";
            } else {
                return "Updation failed";
            }
        } else {
            return "Otp not matched";
        }
    }

    public function setlogin(Request $request)
    {
        if ($request->type == "student") {
            $user = DB::table('students')->where('id', $request->id)->get();
            Session()->put('user_id', $user[0]->id);
            Session()->put('isStudent', 'true');
            return redirect()->route('/');
        }
    }
}
