@extends('layout.layout')
@section('content')

<!-- course purchase -->
<div class="course margin-t30">
    <div class="section">
        <!-- course for you -->
        <?php
        if (count($courses) > 0) {
        ?>
            <div class="course-for-you">
                <div class="heading">
                    <img src="images/star.svg" alt="">
                    Course For You
                </div>
                <div class="course-section flex align-center gap30 margin-t30">
                    <?php

                    foreach ($courses as $courses) {
                    ?>
                        <div class="course-card">
                            <img src="{{$courses->image}}" alt="">
                            <div class="course-overlay">
                                <h2>{{$courses->course_name}}</h2>
                                <div class="flex align-center j-between width100">
                                    <p>5 Days free demo course</p>
                                    <h3>₹ {{$courses->price}}</h3>
                                </div>
                                <div class="flex margin-t10 j-between width100 gap20 align-center">
                                    <button class="fourth-button" onclick="requestDemo('{{$courses->id}}')">Book Demo</button>
                                    <a href="makeCoursePaymet?id={{$courses->id}}" class="text-submit text-white" style="text-decoration: none;"> <button class="primary-button">Buy Now</button></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- course for me -->
        <?php
        if ($mycourse->count() > 0) {
        ?>
            <div class="course-for-you margin-t30">
                <div class="heading">
                    <img src="images/star.svg" alt="">
                    Your Course
                </div>
                <div class="course-section flex align-center gap30 margin-t30">
                    <?php

                    foreach ($mycourse as $mycourses) {
                    ?>
                        <div class="course-card" id="mycourse{{$mycourses->id}}">
                            <img src="{{$mycourses->image}}" alt="">
                            <div class="course-overlay">
                                <div class="cancel" onclick="corseRemoved('{{$mycourses->id}}'),popupopen('confirmPopup')">
                                    <img src="images/cancel-circle.svg" alt="">
                                </div>
                                <span> <?php
                                        if ($mycourses->type == 'demo') {
                                            echo $mycourses->type;
                                        } else {
                                            echo 'Purchased';
                                        }
                                        ?></span>
                                <h2>{{$mycourses->course_name}}</h2>
                                <div class="flex-colomn ">
                                    <p><span>Starting Date :</span> {{date('Y-m-d', strtotime($mycourses->dt))}}</p>
                                    <p><span>Ending Date :</span> {{date('Y-m-d', strtotime($mycourses->renew_date))}}</p>
                                </div>
                                <div class="flex margin-t10 j-between width100 gap20 align-center">
                                    <button class="fourth-button">Know More</button>
                                    <?php
                                    if ($mycourses->type == 'demo') {
                                    ?>
                                        <a href="makeCoursePaymet?id={{$mycourses->id}}" class="text-submit text-white" style="text-decoration: none;"> <button class="primary-button">Book Now</button></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- popup -->
<div id="confirmPopup" class="popup">
    <div class="popup-content flex-colomn align-center j-center gap30">
        <div class="header flex align-center j-between gap50">
            <h2 class="text-center">Are you sure to delete course</h2>
        </div>
        <div class="flex j-between align-center gap30">
            <button type="submit" class="secondary-button" onclick="popupclose('confirmPopup')">Cancel</button>
            <button type="submit" class="secondary-button danger-button" onclick="corseRemovedConfirm()">Delete</button>
        </div>


    </div>
</div>
<input type="hidden" id="remover">
<script>
    function requestDemo(id) {
        $.ajax({
            url: 'takeDemo',
            data: {
                id: id,
            },
            type: 'get',
            success: function(data) {
                alert(data);
            }
        })
    }

    function corseRemoved(id) {
        document.getElementById("remover").value = id;

    }


    function corseRemovedConfirm() {
        var id = $("#remover").val();
        popupclose('confirmPopup');
        $(".modal-backdrop").hide();

        $.ajax({
            url: 'couseDelete',
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    alert("Course will delete soon");
                    $("#mycourse" + id).remove();
                } else {
                    alert(data);
                }
            }
        })
    }
</script>
@endsection