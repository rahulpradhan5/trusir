@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Pincode</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/addedPincode" id="add-course-form" method="get">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" aria-describedby="emailHelp" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">State</label>
                            <select class="form-control" name="state" id="state" required="required" oninput="cityload()">
                                <option value="">Select a state</option>
                                <?php
                                foreach ($states as $stat) {
                                ?>
                                    <option value="{{$stat->name}}" style="text-transform: capitalize;">{{$stat->name}}</option>
                                <?php

                                }
                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">City</label>
                            <select class="form-control" name="city" id="city" required="required">
                                <option value="">Select a city</option>
                                <option value="">Select a state first</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cityload() {
        var state = $("#state").val();
        $.ajax({
            url: "../cityload",
            data: {
                state: state
            },
            type: "get",
            success: function(data) {
                console.log(data);
                da = `<option value="">Select a city</option>`;
                for (var i = 0; i <= data.length - 1; i++) {
                    da = da + `<option value="` + data[i].name + `" style="text-transform: capitalize;">` + data[i].name + `</option>`;
                }
                $("#city").html(da);
            }
        })
    }
</script>
@endsection