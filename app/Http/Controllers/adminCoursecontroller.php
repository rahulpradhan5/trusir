<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class adminCoursecontroller extends Controller
{
    public function index(Request $request)
    {
        $course = DB::table("course")->orderBy('id', 'desc')->get();
        return view("admin.course", compact('course'));
    }

    public function editCourse(Request $request)
    {
        if ($request->id == "") {
            return redirect()->back();
        } else {
            $course = DB::table("course")->where('id', $request->id)->get();
            $subjects = DB::table("subjects")->get();
            $class = DB::table("classes")->get();
            return view("admin.courses.edit-course", compact('course', 'subjects', 'class'));
        }
    }

    public function addCourse(Request $request)
    {
        $subjects = DB::table("subjects")->get();
        $class = DB::table("classes")->get();
        return view("admin.courses.add-course", compact('subjects', 'class'));
    }

    public function addedCourse(Request $request)
    {
        $file = $request->file('fileInput');

        $fileName = time() . '_' . $file->getClientOriginalName();
        if ($file->move(public_path('uploads'), $fileName)) {
            $path = "uploads/" . $fileName;
            $insert = DB::table("course")->insert([
                'course_name' => $request->course_name,
                'subject' => $request->subject,
                'class' => $request->class,
                'price' => $request->price,
                'medium' => $request->medium,
                'image' => $path
            ]);
            if ($insert) {
                return "success";
            }
        } else {
            return "failed";
        }
    }
    public function editaddedCourse(Request $request)
    {
        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');
            $fileName = time() . '_' . $file->getClientOriginalName();
            if ($file->move(public_path('uploads'), $fileName)) {
                $path = "uploads/" . $fileName;
                $insert = DB::table("course")->where('id', $request->id)->update([
                    'course_name' => $request->course_name,
                    'subject' => $request->subject,
                    'class' => $request->class,
                    'price' => $request->price,
                    'medium' => $request->medium,
                    'image' => $path
                ]);
                if ($insert) {
                    return "success";
                }
            } else {
                return "failed";
            }
        } else {
            $path = $request->fileInput;
            $insert = DB::table("course")->where('id', $request->id)->update([
                'course_name' => $request->course_name,
                'subject' => $request->subject,
                'class' => $request->class,
                'price' => $request->price,
                'medium' => $request->medium,
                'image' => $path
            ]);
            if ($insert) {
                return "success";
            } else {
                return "failed";
            }
        }
    }

    public function deleteCourse(Request $request)
    {
        $delete = DB::table('course')->where('id', $request->id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }
    public function addSubject(Request $request)
    {
        $subject = $request->subject;
        $insert = DB::table('subjects')->insert([
            'subject_name' => $subject,
        ]);
        if ($insert) {
            return "success";
        } else {
            return "failed";
        }
    }
    public function addClass(Request $request)
    {
        $subject = $request->subject;
        $insert = DB::table('classes')->insert([
            'class_name' => $subject,
        ]);
        if ($insert) {
            return "success";
        } else {
            return "failed";
        }
    }
    public function loadSubject(Request $request)
    {
        $subjects = DB::table("subjects")->get();
        return $subjects;
    }
    public function loadClass(Request $request)
    {
        $subjects = DB::table("classes")->get();
        return $subjects;
    }


    public function coursepurchased(Request $request)
    {
        $purchased = DB::table('course_purchased')
            ->join('students', 'students.id', 'course_purchased.user_id')
            ->join('course', 'course.id', 'course_purchased.course_id')
            ->leftJoin('teacher_assign', function ($join) {
                $join->on('course_purchased.course_id', '=', 'teacher_assign.course_id')
                    ->on('course_purchased.user_id', '=', 'teacher_assign.student_id');
            })
            ->orderBy('course_purchased.id', 'desc')
            ->select('students.*', 'course.*', 'course_purchased.*', 'teacher_assign.*', 'course_purchased.course_id as course_id', 'course_purchased.id as id', DB::raw('IF(teacher_assign.course_id IS NULL, "not-assigned", "assigned") AS status'))
            ->get();
        //   dd($purchased);
        return view('admin.purchased.course', compact('purchased'));
    }


    public function transactionhistrory(Request $request)
    {
        $transaction = DB::table('transaction')->orderBy('id', 'desc')->get();
        return view('admin.purchased.transaction', compact('transaction'));
    }

    public function coursedeletepage(Request $request)
    {
        $purchased = DB::table('course_delete')->orderBy('course_delete.id', 'desc')
            ->join('students', 'students.id', 'course_delete.student_id')
            ->join('course', 'course.id', 'course_delete.course_id')
            ->select('course_delete.*', 'students.*', 'course.*', 'course_delete.id as id')
            ->get();
        foreach ($purchased as $purchas) {
            $course_purchased = DB::table('course_purchased')->where('course_id', $purchas->course_id)->where('user_id', $purchas->student_id)->get();
            $teacherassign = DB::table('teacher_assign')->where('course_id', $purchas->course_id)->where('student_id', $purchas->student_id)->get();
            $purchas->coursedata = $course_purchased;
            $purchas->teacherassign = $teacherassign;
        }
        // dd($purchased);
        return view('admin.purchased.course_delete', compact('purchased'));
    }


    public function coursedeleteaccept(Request $request)
    {
        $deltecourse = DB::table('course_purchased')->where('course_id', $request->course_id)->where('user_id', $request->id)->delete();
        if ($deltecourse) {
            if ($request->teacher_id == 0) {
                $delete = DB::table('course_delete')->where('id', $request->delete_id)->update([
                    'status' => "accepted",
                ]);
                if ($delete) {
                    return "success";
                } else {
                    return "failed";
                }
            } else {
                $deleteteacher = DB::table('teacher_assign')->where('teacher_id', $request->teacher_id)->where('student_id', $request->id)->delete();
                if ($deleteteacher) {
                    $delete = DB::table('course_delete')->where('id', $request->delete_id)->update([
                        'status' => "accepted",
                    ]);
                    if ($delete) {
                        return "success";
                    } else {
                        return "failed";
                    }
                } else {
                    return 'failed';
                }
            }
        } else {
            return "failed";
        }
    }

    public function acceptreject(Request $request)
    {
        $reject = DB::table('course_delete')->where('id', $request->delete_id)->update([
            'status' => 'rejected'
        ]);
        if ($reject) {
            $notice = DB::table('notice')->insert([
                'title' => 'Course delete request',
                'noticedesc' => 'Your course delete request has been rejected by the authority please contact with them or try again later,Thank you !',
                'student_id' => $request->student_id
            ]);
            if ($notice) {
                return "success";
            } else {
                return "failed";
            }
        }
    }
}
