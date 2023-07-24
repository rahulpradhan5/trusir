@extends('layout.layout')
@section('content')

<!-- all teacher -->
<div class="teachers margin-t30">
    <div class="section">
        <?php
        if (Session()->get("role") == "student") {
        ?>
            <div class="heading">
                <img src="images/star.svg" alt="">
                Teacher assigned
            </div>
        <?php
        } else if (Session()->get("role") == "teacher") {
        ?>
            <div class="heading">
                <img src="images/star.svg" alt="">
                Students
            </div>
        <?php
        }
        ?>
        <div class="post-row flex align-center gap30 flex-wrap margin-t30">
            <?php
            if ($teachers->count() > 0) {
                foreach ($teachers as $teacher) {
                    if (Session()->get("role") == "student") {
            ?>
                        <!-- teacher profile -->
                        <a href="EditTeacher_Profile?id=<?php echo $teacher->id; ?>" style="text-decoration: none;">
                            <div class="teacher-profile-card flex-colomn">
                                <div class="profile-card-img">
                                    <img src="{{$teacher->image}}" alt="">
                                </div>
                                <div class="content flex-colomn ">
                                    <div>
                                        <h3>{{$teacher->name}}</h3>
                                        <p class="tag">{{$teacher->subject}}</p>
                                    </div>
                                   <p>Assign date: {{  $teacher->dt }}</p>

                                </div>
                            </div>
                        </a>
                    <?php
                    } else {
                    ?>
                        <!-- teacher profile -->
                        <a href="My_Profile?id=<?php echo $teacher->id; ?>" style="text-decoration: none;">
                            <div class="teacher-profile-card flex-colomn">
                                <div class="profile-card-img">
                                    <img src="{{$teacher->image}}" alt="">
                                </div>
                                <div class="content flex-colomn ">
                                    <div>
                                        <h3>{{$teacher->name}}</h3>
                                        <div class="flex align-center gap10">
                                            <p class="tag">{{$teacher->subject}}</p>
                                            <p class="tag">{{$teacher->type}}</p>
                                        </div>

                                    </div>
                                    <p>Class: {{$teacher->class}}</p>
                                    <p>Joining date: {{$teacher->dt}}</p>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                }
            } else {
                ?>
                <div class="heading">
                    No data found
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
@endsection