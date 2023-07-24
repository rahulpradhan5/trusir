<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class adminGkcontroller extends Controller
{
    //

    public function index(Request $request)
    {
       $gk = DB::table('gk')->orderBy('id','desc')->get();
       return view('admin.gk.index',compact('gk'));
    }

    public function deleteGk(Request $request)
    {
       $delete = DB::table('gk')->where('id',$request->id)->delete();
       if($delete){
        return "success";
       }else{
        return "failed";
       }
    }

    public function addgk(Request $request)
    {
        return view('admin.gk.add-gk');
    }

    public function addedgk(Request $request)
    {
        if ($request->file('fileInput')) {

            $file = $request->file('fileInput');
            $filename = time() . '_' . $file->getClientOriginalName();

            // File extension
            $extension = $file->getClientOriginalExtension();

            // File upload location
            $location = 'image';

            // Upload file
            if ($file->move($location, $filename)) {
                $filepath = 'image/' . $filename;
               $insert = DB::table('gk')->insert([
                'tittle'=>$request->tittle,
                'category'=>$request->category,
                'disc'=>$request->desc,
                'image'=>$filepath
               ]);
                if($insert){
                    return "success";
                }else{
                    return "failed";
                }
            } else {
                return 'failed';
            }
        }else{
            $insert = DB::table('gk')->insert([
                'tittle'=>$request->tittle,
                'category'=>$request->category,
                'disc'=>$request->desc
               ]);
                if($insert){
                    return "success";
                }else{
                    return "failed";
                }
        }
    }
}
