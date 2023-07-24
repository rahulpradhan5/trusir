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
                                    <h6 class="fw-semibold mb-0">Purchase type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $count = $purchased->count() - 1;

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
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$purchasedd->type}}</p>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/view-student?id={{$purchasedd->user_id}}"><button class="btn btn-primary btn-sm">View</button></a>
                                            </div>
                                            <?php
                                            if ($purchasedd->status == "not-assigned") {
                                            ?>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="/admin/assign?id={{$purchasedd->user_id}}&course_id={{$purchasedd->id}}"><button class="btn btn-success btn-sm">Assign</button></a>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="/admin/view-teacher?id={{$purchasedd->teacher_id}}"><button class="btn btn-success btn-sm">Assigned</button></a>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-danger btn-sm" id="delete{{$purchasedd->id}}" onclick="deleteCourse('{{$purchasedd->id}}','studnet{{$purchasedd->id}}')">Delete</button>
                                            </div>
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