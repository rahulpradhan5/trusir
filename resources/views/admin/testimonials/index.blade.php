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
                <h5 class="card-title fw-semibold mb-4">Testimonials</h5>
                <!-- <div class="search">
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

                </div> -->
                <div class="table-responsive">
                    <table class="table text-nowrap ">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.no</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Picture</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Description</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Active</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <?php

                            if ($testi->count() <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $i = 1;
                                foreach ($testi as $teacher) {
                                ?>
                                    <tr id="testi{{$teacher->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i}}</h6>
                                            <?php $i = $i + 1; ?>
                                        </td>
                                        <td class="border-bottom-0" style="padding-top: 10px !important;">
                                            <img style="width: 50px;height:50px;border-radius:50%;" src="../{{$teacher->img}}">
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$teacher->name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal desc text-truncate " style="width:300px;" id="desc{{$teacher->id}}">{{$teacher->description}}</p>
                                            <span style="cursor: pointer;color:blue;" id="span{{$teacher->id}}" onclick="readmore('{{$teacher->id}}')">Read more</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$teacher->dt}}</p>
                                        </td>
                                        <td class="border-bottom-0" id="checked{{$teacher->id}}">
                                            <?php
                                            if ($teacher->status == "yes") {
                                                $status = "no";
                                            } else {
                                                $status = "yes";
                                            }
                                            ?>
                                            <input type="checkbox" <?php if ($teacher->status == "yes") {
                                                                        echo "checked";
                                                                    } ?> onchange="editstatus('{{$teacher->id}}','{{$status}}')">

                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                               <a href="/admin/edittsesti?id={{$teacher->id}}"><button class="btn btn-primary btn-sm">Edit</button></a> 
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-danger btn-sm" onclick="deletetesti('{{$teacher->id}}')">Delete</button>
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
    function readmore(id) {
        $("#desc" + id).toggleClass("text-truncate");
        $("#desc" + id).toggleClass("text-wrap");
        $("#span" + id).html($("#desc" + id).hasClass("text-wrap") ? "Show less" : "Read more");
    }

    function deletetesti(id) {
        $.ajax({
            url: "/admin/testidelete",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert('Testimoial deleted successfully');
                    $("#testi" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }

    function editstatus(id, type) {

        $.ajax({
            url: "/admin/testistatus",
            data: {
                id: id,
                status: type
            },
            type: 'get',
            success: function(data) {
                console.log(data);
                if (data == "success") {
                    alert('Status changed');
                    if(type == "yes"){
                        $("#checked" + id).html(` <input type="checkbox" checked onchange="editstatus('`+id+`','yes')">`);
                    }else if(type == "no"){
                        $("#checked" + id).html(` <input type="checkbox"  onchange="editstatus('`+id+`','no')">`);
                    }
                    
                } else {
                    alert(data);
                }
            }
        })
    }

    
</script>
@endsection