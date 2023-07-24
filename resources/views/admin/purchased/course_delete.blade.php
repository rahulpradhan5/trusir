@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Course purchased</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.no</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Student Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Phone</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Class</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Medium</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Start date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">End date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Purchase type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $count = $purchased->count();

                            if ($count <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $i = 1;
                                foreach ($purchased as $purchasedd) {
                                ?>
                                    <tr id="course{{$purchasedd->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i }}</h6>
                                            <?php
                                            $i = $i + 1;
                                            ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$purchasedd->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$purchasedd->phone}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Class {{$purchasedd->class}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$purchasedd->medium}}</p>
                                        </td>
                                        <?php
                                        if($purchasedd->coursedata->count() == 0){
                                            $startDate = 'n/a';
                                            $endDate = 'n/a';
                                            $type = 'n/a';
                                        }else{
                                            $startDate = $purchasedd->coursedata[0]->dt;
                                            $endDate = $purchasedd->coursedata[0]->end_date;
                                            $type = $purchasedd->coursedata[0]->type;
                                        }
                                        ?>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$startDate}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$endDate}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$type}}</p>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center gap-2" id="deletecourse{{$purchasedd->id}}">
                                            <?php
                                            if ($purchasedd->status == "no") {
                                            ?>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php
                                                    if ($purchasedd->teacherassign->count() == 0) {
                                                        $teacher_id = 0;
                                                    } else {
                                                        $teacher_id = $purchasedd->teacherassign[0]->teacher_id;
                                                    }
                                                    ?>
                                                    <button class="btn btn-primary btn-sm" onclick="acceptdelete('{{$purchasedd->student_id}}','{{$purchasedd->course_id}}','{{$teacher_id}}','{{$purchasedd->id}}')">Accept</button>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-danger btn-sm" id="delete{{$purchasedd->id}}" onclick="acceptreject('{{$purchasedd->id}}','{{$purchasedd->student_id}}')">Reject</button>
                                                </div>
                                            <?php
                                            } else if ($purchasedd->status == "rejected") {
                                            ?>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-danger btn-sm" id="delete{{$purchasedd->id}}" disabled="disabled">Rejected</button>
                                                </div>
                                            <?php
                                            } else if ($purchasedd->status == "accepted") {
                                            ?>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-success btn-sm" id="delete{{$purchasedd->id}}" disabled="disabled">Accepted</button>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function acceptdelete(id, course_id, teacher_id, delete_id) {
        $.ajax({
            url: "/admin/course_delete_accept",
            data: {
                id: id,
                course_id: course_id,
                teacher_id: teacher_id,
                delete_id: delete_id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Course deleted successfully");
                    $("#deletecourse" + delete_id).html(`<div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-success btn-sm" id="delete{{$purchasedd->id}}" disabled="disabled">Accepted</button>
                                                </div>`);
                } else {                
                    alert(data);
                }
            }
        })
    }
    function acceptreject( delete_id,student_id) {
        $.ajax({
            url: "/admin/acceptreject",
            data: {
                delete_id: delete_id,
                student_id:student_id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Course deleted successfully");
                    $("#deletecourse" + delete_id).html(`<div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-danger btn-sm" id="delete{{$purchasedd->id}}" disabled="disabled">Rejected</button>
                                                </div>`);
                } else {                
                    alert(data);
                }
            }
        })
    }
    
</script>
@endsection