@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex" style="align-items: center;justify-content:space-between;">
                    <h5 class="card-title fw-semibold mb-4">Students</h5>
                    <button class="btn btn-primary btn-sm">Add</button>
                </div>

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
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <?php

                            $count = $students->count();

                            if ($count <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                for ($i = 0; $i <= $count - 1; $i++) {
                                ?>
                                    <tr id="studnet{{$students[$i]->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i + 1}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$students[$i]->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$students[$i]->phone}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Class {{$students[$i]->class}}</p>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/view-student?id={{$students[$i]->id}}"><button class="btn btn-primary btn-sm">View</button></a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="/admin/edit-student?id={{$students[$i]->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-danger btn-sm" id="delete{{$students[$i]->id}}" onclick="deletestudent('{{$students[$i]->id}}','studnet{{$students[$i]->id}}')">Delete</button>
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
    function deletestudent(id) {
        $.ajax({
            url: "/admin/studentdelete",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Student deleted successfully");
                    $('studnet' + id).remove();
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
            url: "/admin/searchstudent",
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
            success: function(data) {
                $("#studentTable").html(data);
            }
        })
    }
</script>
@endsection