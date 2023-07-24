<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class adminTeacherController extends Controller
{
   //
   public function index(Request $request)
   {
      $teachers = DB::table('teachers')->orderBy('id', 'desc')->get();
      foreach ($teachers as &$teacher) {
         $slots = DB::table('slot')
            ->where('slot.teacher_id', $teacher->id)
            ->leftJoin('teacher_assign', function ($join) {
               $join->on('slot.id', '=', 'teacher_assign.slot_id');
            })
            ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
            ->get();
         $teacher->slot = $slots;
      }
      // dd($teachers);
      return view('admin.teacher.index', compact('teachers'));
   }

   public function teachersEnq(Request $request)
   {
      $enq = DB::table('teacher_enquiry')->orderBy('id', 'desc')->get();
      return view('admin.teacher.enquiry', compact('enq'));
   }

   public function viewteacher(Request $request)
   {
      $id = $request->id;
      $teacherdata = DB::table('teachers')->where('id', $id)->get();
      $students = DB::table('teacher_assign')->where('teacher_assign.teacher_id', $id)
         ->join('students', 'students.id', 'teacher_assign.student_id')
         ->join('course', 'course.id', 'teacher_assign.course_id')
         ->join('slot', 'slot.id', 'teacher_assign.slot_id')
         ->select('students.*', 'course.*', 'slot.*', 'students.image as image', 'students.id as id')->get();
      foreach ($students as $student) {
         $attandance = DB::table('attendence')->where('teacher_id', $id)->where('student_id', $student->id)->get();
         $student->attandance = $attandance;
      }
      return view('admin.teacher.view-teacher', compact('teacherdata', 'students'));
   }

   public function deletestudent(Request $request)
   {
      $student_id = $request->id;
      $teacher_id = $request->teacher_id;
      $delete = DB::table('teacher_assign')->where('student_id', $student_id)->where('teacher_id', $teacher_id)->delete();
      if ($delete) {
         return "success";
      } else {
         return "failed";
      }
   }


   public function deleteteacher(Request $request)
   {
      $teacher = DB::table('teachers')->where('id', $request->id)->get();
      $deleteuser = DB::table('users')->where('mobile', $teacher[0]->phone)->delete();
      if ($deleteuser) {
         $delete = DB::table('teachers')->where("id", $request->id)->delete();
         if ($delete) {
            return "success";
         } else {
            return "failed";
         }
      } else {
         return "failed";
      }
   }

   public function searchteacher(Request $request)
   {
      if($request->type == "name"){
         $teachers = DB::table('teachers')->where('name', 'like', '%'.$request->input.'%')->orderBy('id', 'desc')->get();
         foreach ($teachers as &$teacher) {
            $slots = DB::table('slot')
               ->where('slot.teacher_id', $teacher->id)
               ->leftJoin('teacher_assign', function ($join) {
                  $join->on('slot.id', '=', 'teacher_assign.slot_id');
               })
               ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
               ->get();
            $teacher->slot = $slots;
         }
        }else if($request->type == "class"){
         $teachers = DB::table('teachers')->where('preferd_class', 'like', '%'.$request->input.'%')->orderBy('id', 'desc')->get();
         foreach ($teachers as &$teacher) {
            $slots = DB::table('slot')
               ->where('slot.teacher_id', $teacher->id)
               ->leftJoin('teacher_assign', function ($join) {
                  $join->on('slot.id', '=', 'teacher_assign.slot_id');
               })
               ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
               ->get();
            $teacher->slot = $slots;
         }
        }else if($request->type == "phone"){
         $teachers = DB::table('teachers')->where('phone', 'like', '%'.$request->input.'%')->orderBy('id', 'desc')->get();
         foreach ($teachers as &$teacher) {
            $slots = DB::table('slot')
               ->where('slot.teacher_id', $teacher->id)
               ->leftJoin('teacher_assign', function ($join) {
                  $join->on('slot.id', '=', 'teacher_assign.slot_id');
               })
               ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
               ->get();
            $teacher->slot = $slots;
         }
        }else if($request->type == "city"){
         $teachers = DB::table('teachers')->where('city', 'like', '%'.$request->input.'%')->orderBy('id', 'desc')->get();
         foreach ($teachers as &$teacher) {
            $slots = DB::table('slot')
               ->where('slot.teacher_id', $teacher->id)
               ->leftJoin('teacher_assign', function ($join) {
                  $join->on('slot.id', '=', 'teacher_assign.slot_id');
               })
               ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
               ->get();
            $teacher->slot = $slots;
         } 
      }else if($request->type == "state"){
         $teachers = DB::table('teachers')->where('state', 'like', '%'.$request->input.'%')->orderBy('id', 'desc')->get();
         foreach ($teachers as &$teacher) {
            $slots = DB::table('slot')
               ->where('slot.teacher_id', $teacher->id)
               ->leftJoin('teacher_assign', function ($join) {
                  $join->on('slot.id', '=', 'teacher_assign.slot_id');
               })
               ->select('slot.*', DB::raw('IF(teacher_assign.slot_id IS NULL, "not-booked", "booked") AS status'))
               ->get();
            $teacher->slot = $slots;
         }   
      }
        return view("admin.teacher.search.index",compact('teachers'));
   }
}
