@extends('admin.layout.layout')
@section('content')
<style>
    .slots::-webkit-scrollbar {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Teachers</h5>
                <div class="search">
                    <div class="input-group">
                        <select id="type" style="width: 200px !important;border: var(--bs-border-width) solid #DFE5EF;">
                            <option value="name">Name</option>
                            <option value="class">Class</option>
                            <option value="phone">Mobile</option>
                            <option value="city">City</option>
                            <option value="state">State</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Search" id="input" oninput="search()">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.no</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Phone</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Class</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Slot</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <?php

                            if ($teachers->count() <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $i = 1;
                                foreach ($teachers as $teacher) {
                                ?>
                                    <tr id="teacher{{$teacher->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i}}</h6>
                                            <?php $i = $i + 1; ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$teacher->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$teacher->phone}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Class {{$teacher->preferd_class}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="slots" style="max-width: 150px;overflow:scroll;display:flex; gap:10px;">
                                                <?php
                                                if ($teacher->slot->count() == 0) {
                                                ?>
                                                    <div class="adjuster" style="display: flex;flex-direction:column;align-items:center;justify-content:center;background-color:#009aff40;padding:3px 7px;border-radius:5px;">
                                                        <p style="margin-bottom: 0 !important;">N/A</p>
                                                    </div>
                                                    <?php
                                                } else {
                                                    foreach ($teacher->slot as $slot) {
                                                    ?>
                                                        <div class="adjuster" style="display: flex;flex-direction:column;align-items:center;justify-content:center;background-color:#009aff40;padding:3px 7px;border-radius:5px;">
                                                            <?php
                                                            if ($slot->status == "booked") {
                                                            ?>
                                                                <span style="width: 10px;height:10px;border-radius:50%;background-color:red;"></span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span style="width: 10px;height:10px;border-radius:50%;background-color:green;"></span>
                                                            <?php

                                                            }
                                                            ?>
                                                            <p style="margin-bottom: 0 !important;">{{$slot->timing}}</p>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/view-teacher?id={{$teacher->id}}"><button class="btn btn-primary btn-sm">View</button></a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="admin/edit-student?id={{$teacher->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-danger btn-sm" id="delete{{$teacher->id}}" onclick="deleteteacher('{{$teacher->id}}','studnet{{$teacher->id}}')">Delete</button>
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
    function deleteteacher(id) {
        $.ajax({
            url: "/admin/delete-teacher",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert('Teacher deleted successfully');
                    $("#teacher" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }

    function search() {
        var type = $("#type").val();
        var input = $("#input").val();
        $.ajax({
            url: "/admin/searchteacher",
            data: {
                type: type,
                input: input
            },
            type: 'get',
            beforeSend: function() {
                $("#studentTable").html(`<tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        Searching...
                                    </td>
                                </tr>`);
            },
            success:function(data){
                $("#studentTable").html(data);
            }
        })
    }
</script>
@endsection