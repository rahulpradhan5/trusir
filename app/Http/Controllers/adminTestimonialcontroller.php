<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class adminTestimonialcontroller extends Controller
{
    //
    public function index(Request $request)
    {
        $testi = DB::table('testimonial')->orderBy('id', 'desc')->get();
        return view('admin.testimonials.index', compact('testi'));
    }

    public function testidelete(Request $request)
    {
        $delete = DB::table('testimonial')->where('id', $request->id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function testistatus(Request $request)
    {
        $changed = DB::table('testimonial')->where('id', $request->id)->update([
            'status' => $request->status
        ]);
        if ($changed) {
           return "success";
        } else {
            return "failed";
        }
    }

    public function edittsesti(Request $request)
    {
        $testimonial = DB::table('testimonial')->where('id',$request->id)->get();
        return view('admin.testimonials.edit',compact('testimonial'));
    }

    public function testimonailedit(Request $request)
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
                $upodate = DB::table('testimonial')->where('id',$request->id)->update([
                    'img' => $filepath,
                    'name'=>$request->name,
                    'description'=>$request->desc,
                ]);
                if ($upodate) {
                    return Redirect::to(url('/admin/testimonials?id=' . $request->id));
                } else {
                    return Redirect::to(url('/admin/testimonials?id=' . $request->id));
                }
            }
        }else{
            $upodate = DB::table('testimonial')->where('id',$request->id)->update([
                'img' => $request->oldimage,
                'name'=>$request->name,
                'description'=>$request->desc,
            ]);
            if ($upodate) {
                return Redirect::to(url('/admin/testimonials?id=' . $request->id));
            } else {
                return Redirect::to(url('/admin/testimonials?id=' . $request->id));
            }
        }
    }

}
