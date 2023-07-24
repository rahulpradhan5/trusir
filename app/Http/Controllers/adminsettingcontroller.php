<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class adminsettingcontroller extends Controller
{
    //

    public function index(Request $request)
    {
        $price = DB::table('settings')->where('id', '1')->get();
        $sliders = DB::table('apphomesliders')->orderBy('id', 'desc')->get();
        $holiday = DB::table('holidays')->orderBy('id', 'desc')->get();
        return view('admin.setting', compact('price', 'sliders', 'holiday'));
    }

    public function addslider(Request $request)
    {
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
                $upodate = DB::table('apphomesliders')->insert([
                    'type' => $request->type,
                    'sliderImage' => $filepath
                ]);
                if ($upodate) {
                    return Redirect::to(url('/admin/settings'));
                } else {
                    return Redirect::to(url('/admin/settings'));
                }
            }
        }
    }


    public function addholiday(Request $request)
    {
        $upodate = DB::table('holidays')->insert([
            'name' => $request->name,
            'date' => $request->date,
            'month' => $request->month
        ]);
        if ($upodate) {
            return Redirect::to(url('/admin/settings'));
        } else {
            return Redirect::to(url('/admin/settings'));
        }
    }

    public function deleteslider(Request $request)
    {
        $sliderCheck = DB::table('apphomesliders')->where('type', $request->type)->get();
        if ($sliderCheck->count() == 1) {
            return "You can't delete all the slider of a type";
        } else {
            $delete = DB::table('apphomesliders')->where('id', $request->id)->delete();
            if ($delete) {
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function deleteholiday(Request $request)
    {
        $delete = DB::table('holidays')->where('id',$request->id)->delete();
        if($delete){
            return "success";
        }else{
            return "failed";
        }
    }


    public function registrationpriceupdate(Request $request){
        $update = DB::table('settings')->where('id','1')->update([
            'work'=>$request->price
        ]);
        if ($update) {
            return Redirect::to(url('/admin/settings'));
        } else {
            return Redirect::to(url('/admin/settings'));
        }
    }
}
