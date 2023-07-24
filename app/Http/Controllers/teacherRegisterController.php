<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\State;

class teacherRegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        // To get all the countries
        $countries = Country::all();


        // To get all the states from country
        $states = Country::where('name', 'india')->first()->states;
        $stateNames = Country::where('name', 'india')->first()->states->pluck('name');
        $reg = DB::table('settings')->where('id', '1')->get();
        $class = DB::table('classes')->get();
        $subject = DB::table('subjects')->get();
        $pincode = DB::table('pincodes')->get();
        $slots = DB::table('slot_data')->get();
        return view('teacherRegistration', compact('reg', 'class', 'subject', 'pincode', 'states', 'slots'));
    }

    public function cityload(Request $request)
    {
        $cities = State::where('name', $request->state)->first()->cities;
        return $cities;
    }

    public function pincodeload(Request $request)
    {
        $pincode = DB::table('pincodes')->where('city', $request->city)->where('status', 'active')->get();
        return $pincode;
    }
    public function register(Request $request)
    {
        $insertupdate = DB::table('users')->where('mobile', Session()->get('mobile'))->update([
            'role' => 'teacher'
        ]);
        if ($insertupdate) {
            $count = 1;
            $fee = DB::table('settings')->where('id', 1)->get();
            $name = $request->input('studenname1');
            $gender = $request->input('gender1');
            $dob = $request->input('dob1');
            $dob = Carbon::parse($dob);
            $now = Carbon::now();
            $age =  $dob->diffInYears($now);
            $father = $request->input('father1');
            $mother = $request->input('mother1');
            $mobile = Session()->get('mobile');
            $state =  $request->input('state1');
            $city = $request->input('city1');
            $area = $request->input('area1');
            $fulladd = $request->input('fulladd1');
            $exp = $request->exp;
            $quali = $request->qualification;
            $medium = $request->input('medium1');
            $class = $request->input('class1');
            $subject = $request->input('subject1');
            $pincode = $request->input('pincode1');
            if ($request->file('image1')) {

                $file = $request->file('image1');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'image';
            }
            if ($request->file('aadhar1')) {

                $file1 = $request->file('aadhar1');
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
                        $insertdata = DB::table('teachers')->where('phone', Session()->get('mobile'))->get();
                        $counts = 0;
                        for ($i = 0; $i <= count($request->slots) - 1; $i++) {
                            $insertslot = DB::table('slot')->insert([
                                'teacher_id' => $insertdata[0]->id,
                                'timing' => $request->slots[$i]
                            ]);
                            $counts = $counts + 1;
                            if (count($request->slots) == $counts) {
                                Session()->put('amount', $fee[0]->work);
                                Session()->put('payment_type', 'teacher registration');
                                return view('payment');
                            }
                        }
                    }
                }
            }
        }
    }
}
