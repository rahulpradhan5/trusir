<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class testCntroller extends Controller
{
    //
    public function index(Request $request)
    {
        if (Session()->get('role') == "student") {
            $course = DB::table('course_purchased')->where('user_id', Session()->get('user_id'))->join('course','course.id','course_purchased.course_id')->get();
            $test = DB::table('test_upload')->where('student_id', Session()->get('user_id'))->leftjoin('course', 'course.id', 'test_upload.course_id')->orderBy('test_upload.id', 'desc')->select('test_upload.*', 'course.course_name')->get();
        } else if (Session()->get('role') == "teacher") {
            $student_id = $request->id;
            $course = DB::table('teacher_assign')->where('student_id', $student_id)->where('teacher_id', Session()->get('user_id'))->get();
            $test = DB::table('test_upload')->where('test_upload.student_id', $student_id)->where('test_upload.teacher_id', Session()->get('user_id'))->leftjoin('course', 'course.id', 'test_upload.course_id')->orderBy('test_upload.id', 'desc')->select('test_upload.*', 'course.course_name')->get();
        }

        return view("Testseries", compact('course', 'test'));
    }

    public function testUpload(Request $request)
    {

        if ($request->hasfile('questions')) {
            // Get the uploaded files
            $questionfiles = $request->file('questions');

            // Create a unique filename for the zip archive
            $zipFilename = time() . rand(0000, 9999) . '_archive.zip';

            // Create a zip archive
            $zip = new ZipArchive;
            $zipPath = public_path('uploads/' . $zipFilename);

            if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
                foreach ($questionfiles as $file) {
                    // Create a unique filename for each uploaded file
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Save the file to the storage location
                    $file->move(public_path('uploads'), $filename);

                    // Add the file to the zip archive
                    $zip->addFile(public_path('uploads/' . $filename), $filename);
                }

                $zip->close();

                // Save the zip file path to the database
                // Assuming you have a model called File and a 'zip_path' column


            }
        }

        if ($request->hasfile('answers')) {
            $answersfiles = $request->file('answers');
            // Create a unique filename for the zip archive
            $zipFilename1 = time() . rand(0000, 9999) . '_archive.zip';
            $zip = new ZipArchive;
            $zipPath1 = public_path('uploads/' . $zipFilename1);
            if ($zip->open($zipPath1, ZipArchive::CREATE) === true) {
                foreach ($answersfiles as $file) {
                    // Create a unique filename for each uploaded file
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Save the file to the storage location
                    $file->move(public_path('uploads'), $filename);

                    // Add the file to the zip archive
                    $zip->addFile(public_path('uploads/' . $filename), $filename);
                }

                $zip->close();
                
            }
        }
        
        if (Session()->get('role') == "teacher") {
            $course = DB::table('teacher_assign')->where('teacher_id', Session()->get('user_id'))->where('student_id', $request->student_id,)->get();
            $uploadTest = DB::table('test_upload')->insert([
                'title' => $request->title,
                'student_id' => $request->student_id,
                'teacher_id' => Session()->get('user_id'),
                'course_id' => $course[0]->course_id,
                'questions' => 'uploads/' . $zipFilename,
                'answer' => 'uploads/' . $zipFilename1,
            ]);
            if ($uploadTest) {
                return "success";
            } else {
                return "failed";
            }
        } else if (Session()->get('role') == "student") {
            $course = DB::table('teacher_assign')->where('course_id', $request->course)->where('student_id', Session()->get('user_id'))->get();
           
            $uploadTest = DB::table('test_upload')->insert([
                'title' => $request->title,
                'student_id' => Session()->get('user_id'),
                'teacher_id' => $course[0]->teacher_id,
                'course_id' => $request->course,
                'questions' => 'uploads/' . $zipFilename,
                'answer' => 'uploads/' . $zipFilename1,
            ]);
            if ($uploadTest) {
                return "success";
            } else {
                return "failed";
            }
        }
    }
}
