@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="d-flex" style="justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h3>Student Info</h3>

    </div>
    <div class="row">
        <div style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;flex-direction: row;">
                <img src="../{{$student[0]->image}}" class="card-img-top" alt="..." style="height: 250px;width:30%">
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Name:</span> {{$student[0]->name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Father Name:</span> {{$student[0]->father_name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Mother Name:</span> {{$student[0]->mother_name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Phone:</span> +{{$student[0]->phone}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Gender:</span> {{$student[0]->gender}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Age:</span> {{$student[0]->age}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Paid:</span> {{$student[0]->paid}}</p>
                </div>
            </div>
        </div>
        <!-- activator -->
        <div class="flex align-center card " style="padding-top:10px;background-color:white;border-radius:10px;display: flex;">
            <div class="adjuster" style="display: flex;align-items:center;gap:30px;font-weight:bold;">
                <p class="p-active" style="color: black;cursor:pointer;font-size:18px" id="address-p" onclick="shower('.card-div','#address','#address-p')">Address Info</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="study-p" onclick="shower('.card-div','#study','#study-p')">Study info</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="teacher-p" onclick="shower('.card-div','#teacherAssigned','#teacher-p')">Teacher Assigned</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="course-p" onclick="shower('.card-div','#coursePur','#course-p')">Course Purchased</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="test-p" onclick="shower('.card-div','#tests','#test-p')">Test Info</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="progress-p" onclick="shower('.card-div','#progress','#progress-p')">Progress info</p>
            </div>
        </div>
        <!-- address assigned -->
        <div class="card-div" id="address" style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Addresss</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Area:</span> {{$student[0]->area}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Pincode:</span> {{$student[0]->pincode}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">City:</span> {{$student[0]->city}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">State:</span> {{$student[0]->state}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Full address:</span> {{$student[0]->current_full_address}}</p>
                </div>
            </div>
        </div>
        <!-- study info -->
        <div class="card-div" id="study" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Study info</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Class</span> {{$student[0]->class}}th</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Medium:</span> {{$student[0]->medium}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">School:</span> {{$student[0]->school_name}}</p>

                </div>
            </div>
        </div>
        <!-- teacher assigned -->
        <div class="card-div" id="teacherAssigned" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <div class="d-flex" style="align-items:center;justify-content:space-between;">
                    <h4>Teacher Assigned</h4>
                </div>
                <div class="card-body" style="padding: 10px 30px;display:flex;align-items:center;gap:30px;justify-content:flex-start;flex-wrap:wrap;">
                    <?php
                    foreach ($teachers as $teacher) {
                    ?>
                        <div class="card" id="teacherassign{{$teacher->id}}" style="width: 30%;">
                            <img src="../{{$teacher->image}}" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <div class="d-flex" style="justify-content:space-between;align-items:center;">
                                    <h5 class="card-title">{{$teacher->name}}</h5>
                                    <p class="card-text">Subject:{{$teacher->course_name}}</p>
                                </div>
                                <p class="card-text">Attendance:{{collect($teacher->attandance)->where('techer_attend', 'yes')->count()}}</p>
                                <p class="card-text">Absent:{{collect($teacher->attandance)->where('techer_attend', 'no')->count()}}</p>
                                <p class="card-text">Class:{{$student[0]->class}}</p>
                                <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                                    <a class="btn btn-danger" onclick="deleteteacher('{{$teacher->id}}')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- course purchased -->
        <div class="card-div" id="coursePur" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <div class="d-flex" style="align-items:center;justify-content:space-between;">
                    <h4>Course Purchased</h4>
                    <a href="/admin/purchase-course?id={{$_GET['id']}}"><button class="btn btn-primary">Add</button></a>
                </div>
                <div class="card-body" style="padding: 10px 30px;display:flex;align-items:center;gap:30px;justify-content:flex-start;flex-wrap:wrap;">
                    <?php
                    foreach ($courses as $course) {
                    ?>
                        <div class="card" style="max-width: 280px;" id="course{{$course->id}}">
                            <img src="../{{$course->image}}" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <div class="d-flex" style="justify-content:space-between;align-items:center;">
                                    <h5 class="card-title">{{$course->course_name}}</h5>
                                    <p class="card-text">Price:₹{{$course->price}}</p>
                                </div>
                                <p class="card-text">Subject:{{$course->subject}}</p>
                                <p class="card-text">Type:{{$course->type}}</p>
                                <p class="card-text">Class:{{$student[0]->class}}th</p>
                                <p class="card-text">Purchase Date:{{$course->dt}}</p>
                                <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                                    <?php
                                    if ($course->teach_assign == null) {
                                    ?>
                                        <a href="/admin/assign?id={{$_GET['id']}}&course_id={{$course->id}}" class="btn btn-primary">Assign</a>

                                    <?php
                                    } else {
                                    ?>
                                        <a class="btn btn-primary">Assigned</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-danger" onclick="deleteCourse('{{$course->id}}')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Test info -->
        <div class="card-div" id="tests" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <div class="d-flex" style="align-items:center;justify-content:space-between;">
                    <h4>Test Info</h4>
                </div>
                <div class="card-body" style="padding: 10px 30px;display:flex;align-items:center;gap:30px;justify-content:flex-start;flex-wrap:wrap;">
                    <?php
                    foreach ($tests as $test) {
                    ?>
                        <div class="card" id="test{{$test->id}}" style="width: 40%;">
                            <div class="card-body">
                                <div class="d-flex" style="justify-content:space-between;align-items:center;">
                                    <h5 class="card-title">{{$test->title}}</h5>

                                </div>
                                <p>Course: {{$test->course_name}}</p>
                                <p>Posted on: {{$test->dt}}</p>

                                <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                                    <a href="../{{$test->questions}}" class="btn btn-primary" download>Questions</a>
                                    <a href="../{{$test->answer}}" class="btn btn-primary" download>Answers</a>
                                    <a class="btn btn-danger" onclick="deletest('{{$test->id}}')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- progress report -->
        <div class="card-div" id="progress" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <div class="d-flex" style="align-items:center;justify-content:space-between;">
                    <h4>Progress report</h4>
                    <a href="/admin/add-progress?id={{$_GET['id']}}"><button class="btn btn-primary ">Add</button></a>
                </div>
                <div class="card-body" style="padding: 10px 30px;display:flex;align-items:center;gap:30px;justify-content:flex-start;flex-wrap:wrap;">
                    <?php
                    foreach ($progress as $test) {
                    ?>
                        <div class="card" id="progress{{$test->id}}" style="width: 40%;">
                            <div class="card-body">
                                <div class="d-flex" style="justify-content:space-between;align-items:center;">
                                    <h5 class="card-title">{{$test->dt}}</h5>

                                </div>
                                <p>Course: {{$test->course_name}}</p>
                                <p>Marks: {{$test->obtain_marks}}/{{$test->total_marks}}</p>

                                <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                                    <a href="../{{$test->file}}" class="btn btn-primary" download>Download</a>
                                    <a class="btn btn-danger" onclick="deletest('{{$test->id}}')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteteacher(id) {
        $.ajax({
            url: "/admin/deletedeleteteacherassign",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Teacher deleted successfully");
                    $("#teacherassign" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }

    function deletest(id) {
        $.ajax({
            url: "/admin/deletetest",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Test deleted successfully");
                    $("#test" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }

    function deletprogress(id) {
        $.ajax({
            url: "/admin/deleteprogress",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Progress deleted successfully");
                    $("#progress" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }

    function deleteCourse(id) {
        $.ajax({
            url: "/admin/deletecoursepurchased",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Course deleted successfully");
                    $("#course" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }
</script>
@endsection