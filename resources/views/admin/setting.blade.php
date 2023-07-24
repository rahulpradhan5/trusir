@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- activator -->
        <div class="d-flex align-center card " style="padding-top:10px;background-color:white;border-radius:10px;display: flex;">
            <div class="adjuster" style="display: flex;align-items:center;gap:30px;font-weight:bold;">
                <p class="p-active" style="color: black;cursor:pointer;font-size:18px" id="address-p" onclick="shower('.card-div','#address','#address-p')">Registration Price</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="study-p" onclick="shower('.card-div','#slider','#study-p')">Sliders</p>
                <p style="color: black;cursor:pointer;font-size:18px" id="teacher-p" onclick="shower('.card-div','#holiday','#teacher-p')">Holidays</p>
            </div>
        </div>
        <!-- address assigned -->
        <div class="card-div" id="address" style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Registration price</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <form action="/admin/registrationpriceupdate" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Registration price</label>
                            <input type="text" class="form-control" name="price" id="price" aria-describedby="emailHelp" required="required" value="{{$price[0]->work}}" placeholder="Enter price">
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- sliders assigned -->
        <div class="card-div" id="slider" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Sliders</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <form action="/admin/addslider" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Slider image</label>
                            <input type="file" class="form-control" name="file" id="file" aria-describedby="emailHelp" required="required">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Slider type</label>
                            <select class="form-control" name="type" id="type" aria-describedby="emailHelp" required="required">
                                <option value="">Select a type</option>
                                <option value="home">Home</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Sliders</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">S.no</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Image</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">type</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sliders->count() <= 0) {
                                    ?>
                                        <tr>
                                            <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                                <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        foreach ($sliders as $slider) {
                                        ?>

                                            <tr id="slider{{$slider->id}}">
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">1</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="../{{$slider->sliderImage}}" alt="" style="height:70px;width:100px;border-radius:5px;">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{$slider->type}}</p>
                                                </td>
                                                <td class="border-bottom-0 ">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button class="btn btn-danger btn-sm" id="delete" onclick="deleteslider('{{$slider->id}}','{{$slider->type}}')">Delete</button>
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
        <!-- Holiday assigned -->
        <div class="card-div" id="holiday" style="display:none;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;">
            <div class="card " style="width: 100%;display:flex;padding:10px">
                <h4>Holidays</h4>
                <div class="card-body" style="padding: 10px 30px;">
                    <form action="/admin/addholiday" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Occasion Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" required="required" placeholder="Enter holiday name">
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Date</label>
                            <select class="form-control" name="date" id="date" aria-describedby="emailHelp" required="required">
                                <option value="">Select a date</option>
                                <?php
                                for ($date = 1; $date <= 31; $date++) { ?>
                                    <option value="{{$date}}">{{$date}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Holiday Month</label>
                            <select class="form-control" name="month" id="month" aria-describedby="emailHelp" required="required">
                                <option value="">Select a Month</option>
                                <?php
                                for ($date = 1; $date <= 12; $date++) { ?>
                                    <option value="{{$date}}">{{$date}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Holidays</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">S.no</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Occasion</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Date</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Month</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($holiday->count() <= 0) {
                                    ?>
                                        <tr>
                                            <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                                <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $i = 1;
                                        foreach ($holiday as $slider) {
                                        ?>

                                            <tr id="holiday{{$slider->id}}">
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{$i}}</h6>
                                                    <?php
                                                    $i = $i + 1;
                                                    ?>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{$slider->name}}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{$slider->date}}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{$slider->month}}</p>
                                                </td>
                                                <td class="border-bottom-0 ">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button class="btn btn-danger btn-sm" id="delete" onclick="deleteholi('{{$slider->id}}')">Delete</button>
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
    </div>
</div>

<script>
    function deleteslider(id, type) {
        $.ajax({
            url: "/admin/deleteslider",
            data: {
                id: id,
                type: type
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Slider deleted successfully");
                    $("slider" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }
    function deleteholi(id) {
        $.ajax({
            url: "/admin/deleteholiday",
            data: {
                id: id,
            },
            type: 'get',
            success: function(data) {
                console.log(data);
                if (data == "success") {
                    alert("Holiday deleted successfully");
                    $("holiday" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }
</script>
@endsection