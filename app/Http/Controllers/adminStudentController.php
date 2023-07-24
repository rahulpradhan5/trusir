<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


class adminStudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $students = DB::table('students')->orderBy('id', 'desc')->get();
        return view('admin.student.index', compact('students'));
    }

    public function studentEnq(Request $request)
    {
        $enq = DB::table('student_enquary')->orderBy('id', 'desc')->get();
        return view('admin.student.enquery', compact('enq'));
    }

    public function viewStudent(Request $request)
    {

        $student = DB::table('students')->where('id', $request->id)->get();
        $teachers = DB::table('teacher_assign')->where('teacher_assign.student_id', $request->id)->join('teachers', 'teachers.id', 'teacher_assign.teacher_id')
            ->join('course', 'course.id', 'teacher_assign.course_id')->orderBy('teacher_assign.id', 'desc')
            ->select('teacher_assign.*', 'teachers.*', 'course.course_name')->get();
        foreach ($teachers as $teacher) {
            $attandance = DB::table('attendence')->where('teacher_id', $teacher->id)->where('student_id', $request->id)->get();
            $teacher->attandance = $attandance;
        }
        $courses = DB::table('course_purchased')
            ->where('user_id', $request->id)
            ->join('course', 'course.id', 'course_purchased.course_id')
            ->leftjoin('teacher_assign', function ($join) use ($request) {
                $join->on('course.id', 'teacher_assign.course_id')
                    ->where('teacher_assign.student_id', $request->id);
            })
            ->orderBy('course_purchased.id', 'desc')
            ->select('course_purchased.*', 'teacher_assign.id AS teach_assign', 'course.*', 'course_purchased.id as id')
            ->get();
        $tests = DB::table('test_upload')->join('course', 'course.id', 'test_upload.course_id')->orderBY('test_upload.id', 'desc')->get();
        $progress = DB::table('progress_report')->where('progress_report.student_id', $request->id)->orderBy('progress_report.id', 'desc')->join('course', 'course.id', 'progress_report.course_id')->select('progress_report.*', 'course.*', 'progress_report.id as id')->get();
        return view("admin.student.view-student", compact('student', 'teachers', 'courses', 'tests', 'progress'));
    }

    public function editStudent(Request $request)
    {
        $student = DB::table('students')->where('id', $request->id)->get();
        $pincode = DB::table('pincodes')->get();
        $classes = DB::table('classes')->get();
        return view("admin.student.edit", compact('student', 'pincode', 'classes'));
    }

    public function editedstudent(Request $request)
    {
        # code...
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            if ($file->move(public_path('uploads'), $fileName)) {
                $filepath = "uploads/" . $fileName;
                $upodate = DB::table('students')->where('id', $request->id)->update([
                    'name' => $request->name,
                    'father_name' => $request->f_name,
                    'mother_name' => $request->m_name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'age' => $request->age,
                    'class' => $request->class,
                    'medium' => $request->medium,
                    'school_name' => $request->school,
                    'area' => $request->area,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->pincode,
                    'current_full_address' => $request->address,
                    'image' => $filepath
                ]);
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else if (!$request->hasFile('file')) {
            $upodate = DB::table('students')->where('id', $request->id)->update([
                'name' => $request->name,
                'father_name' => $request->f_name,
                'mother_name' => $request->m_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'age' => $request->age,
                'class' => $request->class,
                'medium' => $request->medium,
                'school_name' => $request->school,
                'area' => $request->area,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'current_full_address' => $request->address,
                'image' => $request->oldimage
            ]);
            return redirect()->back();
        }
    }


    public function deletestudent(Request $request)
    {
        $id = $request->id;
        $delete = DB::table('students')->where('id', $id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }


    public function deletedeleteteacherassign(Request $request)
    {
        $id = $request->id;
        $teacher = DB::table('teacher_assign')->where('id', $id)->delete();
        if ($teacher) {
            return "success";
        } else {
            return "failed";
        }
    }


    public function deletetest(Request $request)
    {
        $id = $request->id;
        $teacher = DB::table('test_upload')->where('id', $id)->delete();
        if ($teacher) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function deleteprogress(Request $request)
    {
        $id = $request->id;
        $teacher = DB::table('progress_report')->where('id', $id)->delete();
        if ($teacher) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function purchaseCourse(Request $request)
    {
        $id = $request->id;
        $student = DB::table("students")->where('id', $id)->get();
        $courses = DB::table("course")
            ->where('class', $student[0]->class)
            ->where('medium', $student[0]->medium)
            ->leftJoin('course_purchased', function ($join) use ($id) {
                $join->on('course.id', '=', 'course_purchased.course_id')
                    ->where('course_purchased.user_id', '=', $id);
            })
            ->whereNull('course_purchased.course_id')
            ->select('course.*')
            ->get();
        return view('admin.student.add-course', compact('courses'));
    }

    public function givecourse(Request $request)
    {
        $id = $request->id;
        $course_id = $request->course;
        $type = $request->type;
        $currentDate = Carbon::now();
        // Add 5 days to the current date
        $futureDate = $currentDate->addDays(30);
        // Display the future date
        $enddate = $futureDate->toDateString();
        $userUpdate = DB::table('course_purchased')->insert([
            'course_id' => $course_id,
            'user_id' => $id,
            'type' => $type,
            'end_date' => $enddate,
            'renew_date' => $enddate
        ]);
        if ($userUpdate) {
            return Redirect::to(url('/admin/view-student?id=' . $id));
        } else {
            return Redirect::to(url('/admin/view-student?id=' . $id));
        }
    }

    public function deletecoursepurchased(Request $request)
    {
        $id = $request->id;
        $delete = DB::table("course_purchased")->where('id', $id)->delete();
        if ($delete) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function addProgress(Request $request)
    {
        $id = $request->id;
        $courses = DB::table('teacher_assign')->where('teacher_assign.student_id', $id)->join('course', 'course.id', 'teacher_assign.course_id')->select('course.*')->get();
        return view('admin.student.add-progress', compact('courses'));
    }

    public function progressadd(Request $request)
    {
        $teacher = DB::table('teacher_assign')->where('student_id', $request->id)->where('course_id', $request->course)->get();
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
                $upodate = DB::table('progress_report')->insert([
                    'teacher_id' => $teacher[0]->teacher_id,
                    'student_id' => $request->id,
                    'course_id' => $request->course,
                    'obtain_marks' => $request->obtainmark,
                    'total_marks' => $request->totalmarks,
                    'file' => $filepath
                ]);
                if ($upodate) {
                    return Redirect::to(url('/admin/view-student?id=' . $request->id));
                } else {
                    return Redirect::to(url('/admin/view-student?id=' . $request->id));
                }
            }
        }
    }


    public function assign(Request $request)
    {
        $id = $request->id;
        $course_id = $request->course_id;
        $student = DB::table('students')->where('id', $id)->get();
        $teachers = DB::table('teachers')->where('preferd_class', $student[0]->class)->where('city', $student[0]->city)->where('medium', $student[0]->medium)
            ->leftJoin('teacher_assign', function ($join) use ($id) {
                $join->on('teacher_assign.teacher_id', '=', 'teachers.id')
                    ->where('teacher_assign.student_id', '=', $id);
            })
            ->whereNull('teacher_assign.teacher_id')
            ->select('teachers.*')->get();
        return view('admin.student.assign', compact('teachers'));
    }


    public function loadslot(Request $request)
    {
        $id = $request->id;
        $slot = DB::table('slot')->where('slot.teacher_id', $id)
            ->leftJoin('teacher_assign', function ($join) use ($id) {
                $join->on('teacher_assign.teacher_id', '=', 'slot.teacher_id')
                    ->where('teacher_assign.teacher_id', '=', $id);
            })
            ->whereNull('teacher_assign.slot_id')
            ->select('slot.*')->get();
        return $slot;
    }


    public function assignteacher(Request $request)
    {
        $id = $request->id;
        $course_id = $request->course;
        $teacher_id = $request->teacher;
        $slot = $request->slot;
        $course = DB::table("course_purchased")->where('id', $course_id)->get();
        $insert = DB::table('teacher_assign')->insert([
            'student_id' => $id,
            'course_id' => $course[0]->course_id,
            'teacher_id' => $teacher_id,
            'slot_id' => $slot
        ]);
        if ($insert) {
            return Redirect::to(url('/admin/view-student?id=' . $request->id));
        } else {
            return Redirect::to(url('/admin/view-student?id=' . $request->id));
        }
    }

    public function searchstudent(Request $request)
    {
       if($request->type == "name"){
        $students = DB::table('students')->where('name', 'like', '%'.$request->input.'%') ->get();
       }else if($request->type == "class"){
        $students = DB::table('students')->where('class', 'like', '%'.$request->input.'%') ->get();
       }else if($request->type == "phone"){
        $students = DB::table('students')->where('phone', 'like', '%'.$request->input.'%') ->get();
       }else if($request->type == "city"){
        $students = DB::table('students')->where('city', 'like', '%'.$request->input.'%') ->get();
       }else if($request->type == "state"){
        $students = DB::table('students')->where('state', 'like', '%'.$request->input.'%') ->get();
       }

       return view('admin.student.search.index',compact('students'));
    }

    public function studentdelete(Request $request){
        $delete = DB::table('students')->where('id',$request->id)->delete();
        if($delete){
            return "success";
        }else{
            return "failed";
        }
    }
}
