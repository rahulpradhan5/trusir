<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class gkController extends Controller
{
    //
    public function index(Request $request)
    {
        $category = DB::table('gk')
            ->select('category', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();
        if (Session()->get('role') == 'student') {
            $newGK =  DB::table('gk')->orderBy('id', 'desc')->limit(2)->where(function ($query) {
                $query->where('student_id', null)
                    ->orWhere('student_id', Session()->get('user_id'));
            })->get();
            $gk = DB::table('gk')
                ->orderBy('id', 'desc')
                ->where(function ($query) {
                    $query->where('student_id', null)
                        ->orWhere('student_id', Session()->get('user_id'));
                })
                ->limit(5)
                ->get();
        } else if (Session()->get('role') == 'teacher') {
            $newGK =  DB::table('gk')->orderBy('id', 'desc')->limit(2)->where(function ($query) {
                $query->where('teacher_id', null)
                    ->orWhere('teacher_id', Session()->get('user_id'));
            })->get();
            $gk = DB::table('gk')->orderBy('id', 'desc')->limit(5)->where(function ($query) {
                $query->where('teacher_id', null)
                    ->orWhere('teacher_id', Session()->get('user_id'));
            })->get();
        }
        $students = DB::table('teacher_assign')->where('teacher_id', Session()->get('user_id'))->join('students', 'students.id', 'teacher_assign.student_id')->get();
        return view('General_Knowledge', compact('category', 'gk', 'students', 'newGK'));
    }
    public function addGk(Request $request)
    {
        $title = $request->tittle;
        $description = $request->description;
        $student_id = $request->student_id;
        $cate = $request->cate;

        //  return ([$name,$dob,$school_name,$class,$subject,$request->file('file')]);
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
                $upodate = DB::table('gk')->insert([
                    'tittle' => $title,
                    'disc' => $description,
                    'category' => $cate,
                    'student_id' => $student_id,
                    'teacher_id' => Session()->get('user_id'),
                    'image' => $filepath
                ]);
                if ($upodate) {
                    return "success";
                } else {
                    return "failed";
                }
            }
        } else {
            $upodate = DB::table('gk')->insert([
                'tittle' => $title,
                'disc' => $description,
                'category' => $cate,
                'student_id' => $student_id,
                'teacher_id' => Session()->get('user_id')
            ]);
            if ($upodate) {
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function gkCateload(Request $request)
    {
        $name = $request->catename;
        if ($name == 'all') {
            if (Session()->get('role') == 'student') {
                $gk = DB::table('gk')->orderBy('id', 'desc')->where(function ($query) {
                    $query->where('student_id', null)
                        ->orWhere('student_id', Session()->get('user_id'));
                })
                    ->get();
            } else if (Session()->get('role') == 'teacher') {
                $gk = DB::table('gk')->orderBy('id', 'desc')->where(function ($query) {
                    $query->where('teacher_id', null)
                        ->orWhere('teacher_id', Session()->get('user_id'));
                })
                    ->get();
            }
            return view('gkloader', compact('gk'));
        } else if ($name == 'forme') {
            $gk = DB::table('gk')
                ->where('student_id', Session()->get('user_id'))->orderBy('id', 'desc')
                ->get();
            return view('gkloader', compact('gk'));
        } else if ($name == 'myPost') {
            $gk = DB::table('gk')
                ->where('teacher_id', Session()->get('user_id'))->orderBy('id', 'desc')
                ->get();
            $me = 'yes';
            return view('gkloader', compact('gk', 'me'));
        } else if (isset($request->loadmore)) {
            if (Session()->get('role') == 'student') {
                $gk = DB::table('gk')->orderBy('id', 'desc')->where('id', '<', $request->starting)->limit($request->limit)->where(function ($query) {
                    $query->where('student_id', null)
                        ->orWhere('student_id', Session()->get('user_id'));
                })->get();
            } else if (Session()->get('role') == 'teacher') {
                $gk = DB::table('gk')->orderBy('id', 'desc')->where('id', '<', $request->starting)->limit($request->limit)->where(function ($query) {
                    $query->where('teacher_id', null)
                        ->orWhere('teacher_id', Session()->get('user_id'));
                })->get();
            }
            $loadmore = 'yes';
            return view('gkloader', compact('gk', 'loadmore'));
        } else {
            if (Session()->get('role') == 'student') {
                $gk = DB::table('gk')
                    ->where('category', 'LIKE', '%' . $name . '%')->orderBy('id', 'desc')->where(function ($query) {
                        $query->where('student_id', null)
                            ->orWhere('student_id', Session()->get('user_id'));
                    })
                    ->get();
            } else if (Session()->get('role') == 'teacher') {
                $gk = DB::table('gk')
                    ->where('category', 'LIKE', '%' . $name . '%')->orderBy('id', 'desc')->where(function ($query) {
                        $query->where('teacher_id', null)
                            ->orWhere('teacher_id', Session()->get('user_id'));
                    })
                    ->get();
            }

            return view('gkloader', compact('gk'));
        }
    }

    public function deleteGK(Request $request)
    {
        $delete = DB::table('gk')->where('id', $request->id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }
}
