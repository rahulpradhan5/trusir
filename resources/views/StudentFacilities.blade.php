@extends('layout.layout')
@section('content')
<style>
  .col-lg-2 img {
    height: 70px;
    width: 60px;
  }
</style>
<div class="mt-4 mb-4 text-center">
  <h3 class="student_fac">Student Facilities</h3>
</div>

<!-- Address Div start -->
<div class="row  row_padding">
  <div class="col-lg-3 col-md-3">
  </div>

  <div class="row d-flex justify-content-center">

    <div class="col-lg-6 col-md-6  disha_back  mb-4">
      <div class="d-flex ">


        <div class="col-lg-9 col-md-9">
          <h4 class="pt-4 px-4 text-white shah_color">{{$profile[0]->name}}</h4>
          <span class="mx-4 num_info text-white">{{$profile[0]->city.','.$profile[0]->state}} </span>
          <p class="mx-4 num_info text-white">{{$profile[0]->phone}} </p>
        </div>
        <div lass="col-lg-3 col-md-3 ">
          <img class="mt-3 mx-5 dish_img" src="<?php echo asset($profile[0]->image); ?> " alt="" style="width:150px;height:150px;border-radius:50px;">
        </div>
      </div>

    </div>


  </div>



</div>
<!-- Address Div end -->

<!-- Profile Page Start -->
<!-- 1 st Row Start -->
<div class="row ">
  <div class="col-lg-3">
  </div>
  <div class="col-lg-6  mb-4">
    <div class="row d-flex  mb-5 justify-content-center ">
      <?php if (Session()->get('role') == 'student') { ?>
        <div class="col-lg-2 profile_img text-center  mx-2 mt-3" style="background-color:#c2d6e5;">
          <a href="My_Profile">
            <img src="{{ asset('image/Std_Profile.png ')}}" width="108" alt="" height="95" class="Img_media ">
            <p class="text-center pro_img1 mt-1">My Profile</p>
          </a>
        </div>
      <?php
      } else {
      ?>
        <div class="col-lg-2 profile_img text-center  mx-2 mt-3" style="background-color:#c2d6e5;">
          <a href="EditTeacher_Profile?id=<?php echo Session()->get("user_id"); ?>">
            <img src="{{ asset('image/Std_Profile.png ')}}" width="108" alt="" height="95" class="Img_media ">
            <p class="text-center pro_img1 mt-1">My Profile</p>
          </a>
        </div>
      <?php
      }
      ?>
      <?php if (Session()->get('role') == 'student') {
        if ($purchas == 'yes') { ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#de94d8;">
            <a href="Teacher_Profile">
              <img src="{{ asset('image/Std_teacher.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Teacher Profile</p>
            </a>
          </div>
        <?php
        } else {
        ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#de94d8;">
            <a href="courses">
              <img src="{{ asset('image/Std_teacher.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Teacher Profile</p>
            </a>
          </div>
        <?php
        }
      } else if (Session()->get('role') == 'teacher') {
        ?>
        <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#de94d8;">
          <a href="Teacher_Profile">
            <img src="{{ asset('image/Std_teacher.png')}}" width="108" alt="" height="95" class="Img_media ">
            <p class="text-center pro_img1 mt-1">Student List</p>
          </a>
        </div>
      <?php
      }
      ?>
      <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#dae8b5;">
        <a href="Notice"> <img src="{{ asset('image/Std_Notics.png')}}" width="108" height="95" class="Img_media ">
          <p class="text-center pro_img1 mt-1">Notice</p>
        </a>
      </div>

      <?php if (Session()->get('role') == 'student') {
        if ($purchas == 'yes') { ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
            <a href="Attendance"> <img src="{{ asset('image/Std_Atteandance.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Attendance</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#b5e7c7;">
            <a href="Fee_Payment"> <img src="{{ asset('image/Std_Payment.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Fee Payment</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#c2d6e5;">
            <a href="Testseries"> <img src="{{ asset('image/Std_text.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Test Series</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#de94d8;">
            <a href="progress"> <img src="{{ asset('image/Std_Progess.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Progess Report</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#c2d6e5;">
            <a href="Student_doubt"> <img src="{{ asset('image/Std_Doubht.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Student Doubt</p>
            </a>
          </div>

          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#de94d8;">
            <a href="ParentsDoubt"> <img src="{{ asset('image/Std_Parent.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Parents Doubt</p>
            </a>
          </div>
        <?php
        } else {
        ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
            <a href="courses"> <img src="{{ asset('image/Std_Atteandance.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Attendance</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#b5e7c7;">
            <a href="courses"> <img src="{{ asset('image/Std_Payment.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Fee Payment</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#c2d6e5;">
            <a href="courses"> <img src="{{ asset('image/Std_text.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Test Series</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3" style="background-color:#de94d8;">
            <a href="courses"> <img src="{{ asset('image/Std_Progess.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Progess Report</p>
            </a>
          </div>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#c2d6e5;">
            <a href="courses"> <img src="{{ asset('image/Std_Doubht.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Student Doubt</p>
            </a>
          </div>

          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#de94d8;">
            <a href="courses"> <img src="{{ asset('image/Std_Parent.png')}}" width="108" alt="" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">Parents Doubt</p>
            </a>
          </div>
        <?php
        }
      }
      if (Session()->get('role') == 'student') {
        if ($purchas == 'yes') { ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
            <a href="General_Knowledge"> <img src="{{ asset('image/Std_Gk.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">GK</p>
            </a>
          </div>
        <?php
        } else {
        ?>
          <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
            <a href="courses"> <img src="{{ asset('image/Std_Gk.png')}}" alt="" width="108" height="95" class="Img_media ">
              <p class="text-center pro_img1 mt-1">GK</p>
            </a>
          </div>
        <?php
        }
      } else if (Session()->get('role') == 'teacher') {
        ?>
        <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
          <a href="General_Knowledge"> <img src="{{ asset('image/Std_Gk.png')}}" alt="" width="108" height="95" class="Img_media ">
            <p class="text-center pro_img1 mt-1">GK</p>
          </a>
        </div>
      <?php
      }
      ?>

      <div class="col-lg-2 profile_img text-center  mx-2 mt-3 mb-3 " style="background-color:#ebb8bd;">
        <a href="logout"> <img src="{{ asset('image/logout1.png')}}" width="108" height="95" class="Img_media ">
          <p class="text-center pro_img1 mt-1">Logout</p>
        </a>
      </div>
    </div>


  </div>
</div>

  @endsection