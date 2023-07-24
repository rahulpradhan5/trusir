<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Razorpay\Api\Api;
use Carbon\Carbon;

class paymentController extends Controller
{
    //
    public function payment(Request $request)
    {
        $user_id = 1;
        $input = $request->all();
        $api = new Api(env('API_KEY'), env('API_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return back()->withError($e->getMessage());
            }
        }
        // dd($response);
        $user_id = Session()->get('mobile');
        $insert = DB::table('transaction')->insert([
            'mobile' => $user_id,
            'transaction_id' => $response['id'],
            'status' => $response['status'],
            'amount' => Session()->get('amount'),
            'type' =>  Session()->get('payment_type'),
        ]);
        if ($response['status'] == "captured") {
            if (Session()->get('payment_type') == "student registration") {
                $userUpdate = DB::table('students')->where('phone', Session()->get('mobile'))->update([
                    'paid' => 'yes'
                ]);
                if ($userUpdate) {
                    
                    Session()->forget('amount');
                    Session()->forget('payment_type');
                    return redirect()->route('logout');
                }
            } else if (Session()->get('payment_type') == "Add course") {
                $currentDate = Carbon::now();
                // Add 5 days to the current date
                $futureDate = $currentDate->addDays(30);
                // Display the future date
                $enddate = $futureDate->toDateString();
                $demoCheck = DB::table('course_purchased')->where('user_id', Session()->get('user_id'))->where('course_id', Session()->get('course_id'))->where('type', 'demo')->get();
                if ($demoCheck->count() > 0) {
                    $userUpdate = DB::table('course_purchased')->where('id', $demoCheck[0]->id)->update([
                        'type' => 'purchased',
                        'end_date' => $enddate,
                        'renew_date' => $enddate
                    ]);
                    if ($userUpdate) {
                        Session()->forget('amount');
                        Session()->forget('payment_type');
                        Session()->forget('course_id');
                        return redirect()->route('courses');
                    }
                } else {
                    $userUpdate = DB::table('course_purchased')->insert([
                        'course_id' =>  Session()->get('course_id'),
                        'user_id' => Session()->get('user_id'),
                        'type' => 'purchased',
                        'end_date' => $enddate,
                        'renew_date' => $enddate
                    ]);
                    if ($userUpdate) {
                        Session()->forget('amount');
                        Session()->forget('payment_type');
                        Session()->forget('course_id');
                        return redirect()->route('courses');
                    }
                }
            } else if (Session()->get('payment_type') == "teacher registration") {
                $userUpdate = DB::table('teachers')->where('phone', Session()->get('mobile'))->update([
                    'paid' => 'yes'
                ]);
                if ($userUpdate) {
                   
                    Session()->forget('amount');
                    Session()->forget('payment_type');
                    return redirect()->route('logout');
                }
            } else if (Session()->get('payment_type') == "renew course") {
                $user_id = Session()->get('user_id');
                $courseid = Session()->get('course_id');
                $currentDate = Carbon::now();
                // Add 5 days to the current date
                $futureDate = $currentDate->addDays(30);
                // Display the future date
                $enddate = $futureDate->toDateString();
                $userUpdate = DB::table('course_purchased')->where('course_id', $courseid)->where('user_id', $user_id)->update([
                    'type' => 'purchased',
                    'end_date' => $futureDate,
                    'renew_date' => $currentDate
                ]);
                if ($userUpdate) {
                    Session()->forget('amount');
                    Session()->forget('payment_type');
                    Session()->forget('course_id');
                    return redirect()->route('courses');
                }
            }
        } else {
            return view("payment_status", ['response' => $response]);
        }
    }


    public function priceCheck(Request $request)
    {
        $noOfStudent = $request->noofstuden;
        $price = DB::table('settings')->where('id', '1')->get();
        return  $noOfStudent * $price[0]->work * 100;
    }
}
