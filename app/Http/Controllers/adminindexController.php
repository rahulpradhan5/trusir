<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Country;
use App\Models\State;

class adminindexController extends Controller
{
    //
    public function index(Request $request)
    {
        $students = DB::table('students')->orderBy('id', 'desc')->get();
        $teacher = DB::table('teachers')->orderBy('id', 'desc')->get();
        $student_enq = DB::table('student_enquary')->orderBy('id', 'desc')->get();
        $teacher_enq = DB::table('teacher_enquiry')->orderBy('id', 'desc')->get();
        $payment = DB::table('transaction')->where('status', 'captured')->sum('amount');
        return view('admin.index', compact('students', 'teacher', 'student_enq', 'teacher_enq', 'payment'));
    }

    // pincode section-------------------------------------------------------------------------------------

    public function pincodes(Request $request)
    {
        $pincode = DB::table('pincodes')->orderBy('id', 'desc')->get();
        return view('admin.pincode', compact('pincode'));
    }



    public function addpincodes(Request $request)
    {
        // To get all the countries
        $countries = Country::all();
        // To get all the states from country
        $states = Country::where('name', 'india')->first()->states;
        $stateNames = Country::where('name', 'india')->first()->states->pluck('name');
        return view('admin.pincode.add-pincode',compact('states'));
    }

    public function addedpincode(Request $request)
    {
        $insert = DB::table('pincodes')->insert([
            'pincode' => $request->pincode,
            'status' => $request->status,
            'city'=>$request->city,
            'state'=>$request->state
        ]);
        if ($insert) {
            return redirect('/admin/pincodes');
        } else {
            return view("admin.pincode.add-pincode", ['message' => 'failed']);
        }
    }


    public function editededPincode(Request $request)
    {
        $insert = DB::table('pincodes')->where('id', $request->id)->update([
            'pincode' => $request->pincode,
            'status' => $request->status,
            'city'=>$request->city,
            'state'=>$request->state
        ]);
        if ($insert) {
            return redirect('/admin/pincodes');
        } else {
            return view("admin.pincode.add-pincode", ['message' => 'failed']);
        }
    }

    public function editpincode(Request $request)
    {
        $pincode = DB::table('pincodes')->where('id', $request->id)->get();
        return view("admin.pincode.edit-pincode", compact('pincode'));
    }

    public function deletepin(Request $request)
    {
        $delete = DB::table("pincodes")->where("id", $request->id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }

     public function class(Request $request)
    {
      $class = DB::table('classes')->get();
      return view('admin.class',compact('class'));
    }

    public function classdelete(Request $request){
        $delete = DB::table('classes')->where('id',$request->id)->delete();
        if($delete){
            return "success";
        }else{
            return "failed";
        }
    }

    public function subjects(Request $request)
    {
      $class = DB::table('subjects')->get();
      return view('admin.subjects',compact('class'));
    }

    public function subjectsdelete(Request $request){
        $delete = DB::table('subjects')->where('id',$request->id)->delete();
        if($delete){
            return "success";
        }else{
            return "failed";
        }
    }
}
