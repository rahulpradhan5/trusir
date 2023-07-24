@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="d-flex" style="justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h3>Teacher Info</h3>

    </div>
    <div class="row">
        <div style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;flex-direction: row;">
                <img src="../{{$teacherdata[0]->image}}" class="card-img-top" alt="..." style="height: 250px;width:30%">
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Name:</span> {{$teacherdata[0]->name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Father Name:</span> {{$teacherdata[0]->father_name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Mother Name:</span> {{$teacherdata[0]->mother_name}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Phone:</span> +{{$teacherdata[0]->phone}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Gender:</span> {{$teacherdata[0]->gender}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Age:</span> {{$teacherdata[0]->age}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Paid:</span> {{$teacherdata[0]->paid}}</p>
                </div>
            </div>
        </div>
        <!-- activator -->
        <div class="flex align-center card " style="padding-top:10px;background-color:white;border-radius:10px;display: flex;">
            <div class="adjuster" style="display: flex;align-items:center;gap:30px;font-weight:bold;">
                <p class="p-active" style="color: black;cursor:pointer;font-size:18px" id="address-p" onclick="shower('.card-div','#address','#address-p')">Address Info</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="study-p" onclick="shower('.card-div','#study','#study-p')">Study info</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="teacher-p" onclick="shower('.card-div','#teacherAssigned','#teacher-p')">Student Assigned</p>
            </div>
        </div>
        <!-- address assigned -->
        <div class="card-div" id="address" style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Addresss</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Area:</span> {{$teacherdata[0]->area}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Pincode:</span> {{$teacherdata[0]->pincode}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">City:</span> {{$teacherdata[0]->city}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">State:</span> {{$teacherdata[0]->state}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Full address:</span> {{$teacherdata[0]->current_full_address}}</p>
                </div>
            </div>
        </div>
        <!-- study info -->
        <div class="card-div" id="study" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Study info</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <p><span style="font-weight: bolder;font-size:medium;">Class</span> {{$teacherdata[0]->preferd_class}}th</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Medium:</span> {{$teacherdata[0]->medium}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Experience:</span> {{$teacherdata[0]->exp}}</p>
                    <p><span style="font-weight: bolder;font-size:medium;">Qualifiaction:</span> {{$teacherdata[0]->qulification}}</p>

                </div>
            </div>
        </div>
        <!-- teacher assigned -->
        <div class="card-div" id="teacherAssigned" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <div class="d-flex" style="align-items:center;justify-content:space-between;">
                    <h4>Student Assigned</h4>
                </div>
                <div class="card-body" style="padding: 10px 30px;display:flex;align-items:center;gap:30px;justify-content:flex-start;flex-wrap:wrap;">
                    <?php
                    foreach ($students as $teacher) {
                    ?>
                        <div class="card" id="teacherassign{{$teacher->id}}" style="width: 30%;">
                            <img src="../{{$teacher->image}}" class="card-img-top" alt="..." style="height: 250px;">
                            <div class="card-body">
                                <div class="d-flex" style="justify-content:space-between;align-items:center;">
                                    <h5 class="card-title">{{$teacher->name}}</h5>
                                    <p class="card-text">Subject:{{$teacher->course_name}}</p>
                                </div>
                                <p class="card-text">Attendance:{{collect($teacher->attandance)->where('student_attend', 'yes')->count()}}</p>
                                <p class="card-text">Absent:{{collect($teacher->attandance)->where('student_attend', 'no')->count()}}</p>
                                <p class="card-text">Class:{{$teacherdata[0]->preferd_class}}</p>
                                <p class="card-text">Slot:{{$teacher->timing}}</p>

                                <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                                <a href="/admin/view-student?id={{$teacher->id}}" class="btn btn-primary" >View</a>
                                    <a class="btn btn-danger" onclick="deleteteacher('{{$teacher->id}}','{{$teacherdata[0]->id}}')">Delete</a>
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
    function deleteteacher(id,teacherid) {
        $.ajax({
            url: "/admin/delete-student",
            data: {
                id: id,
                teacher_id:teacherid
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Student deleted successfully");
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