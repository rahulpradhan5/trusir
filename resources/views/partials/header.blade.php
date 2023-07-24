<!-- navbar -->
<div class="navbar primary-background">
  <div class="section ">
    <div class="two-section adjuster gap30 d-navbar">
      <div class="logo">
        <a href="/"><img src="images/logo.png" alt="logo"></a>
      </div>
      <ul class="nav-items flex align-center j-center gap30">
        <a href="/">
          <li>Home</li>
        </a>
        <?php
        if (Session()->get('role') == 'student') {
        ?>
          <a href="courses">
            <li>Courses</li>
          </a>
          <a href="General_Knowledge">
            <li>General knowledge</li>
          </a>
          <a href="Contact_us">
            <li>Contact us</li>
          </a>
        <?php
        } else if (Session()->get('role') == 'teacher') {
        ?>
          <a href="Teacher_Profile">
            <li>Student List</li>
          </a>
          <a href="General_Knowledge">
            <li>General knowledge</li>
          </a>
          <a href="Contact_us">
            <li>Contact us</li>
          </a>
        <?php
        } else {
        ?>

          <a href="teacherRegistration">
            <li>Become a teacher</li>
          </a>
          <a href="StudentRegistration">
            <li>Join as student</li>
          </a>
          <a href="Contact_us">
            <li>Contact us</li>
          </a>
        <?php
        }
        ?>
        <?php
        if (!Session()->has('mobile')) {
        ?>
          <a href="Login">
            <li>
              <div>
                <button class="primary-button">Login</button>
              </div>
            </li>
          </a>
        <?php
        }
        ?>
        <?php
        if (Session()->has('mobile')) {
        ?>
          <li>
            <div class="ham_menu">
              <img src="images/user.svg" alt="">
            </div>
          </li>
        <?php
        }
        ?>
        <li class="d-none"><a href="login"><Button class="primary-button">Login</Button></a></li>
      </ul>
    </div>
    <div class="two-section adjuster gap30 m-navbar">
      <div class="logo">
        <a href="/"><img src="images/logo.png" alt="logo"></a>
      </div>

      <div class="ham_menu" id="ham_menu2">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>

    </div>
    <div class="m-navbar-div">
      <ul class="flex-colomn gap10">
        <a href="/">
          <li>Home</li>
        </a>
        <?php
        if (Session()->has('role') && Session()->get('role') != "none") {
        ?>
          <a href="Notice?id=<?php echo Session()->get('user_id'); ?>">
            <li>Notice</li>
          </a>
        <?php
        }
        ?>
        <?php
        if (Session()->get('role') == 'student') {
        ?>
          <a href="courses">
            <li>Courses</li>
          </a>
          <a href="General_Knowledge">
            <li>General knowledge</li>
          </a>
          <a href="Contact_us">
            <li>Contact us</li>
          </a>
        <?php
        } else if (Session()->get('role') == 'teacher') {
        ?>
          <a href="Teacher_Profile">
            <li>Student List</li>
          </a>
          <a href="General_Knowledge">
            <li>General knowledge</li>
          </a>
          <a href="Contact_us">
            <li>Contact us</li>
          </a>
        <?php
        } else {
        ?>
          <a href="teacherRegistration">
            <li>Become a teacher</li>
          </a>
          <a href="StudentRegistration">
            <li>Join as student</li>
          </a>
        <?php
        }
        ?>
        <?php
        if (Session()->get('role') == "teacher") {
        ?>
          <a href="EditTeacher_Profile?id={{Session()->get('user_id')}}">
            <li class="flex j-between align-center profile">Profile</li>
          </a>
        <?php
        } else if (Session()->get('role') == "student") {
        ?>
          <li class="flex j-between align-center profile">Profile <img src="images/drop.svg" alt=""></li>
          <ul class="child-cate">

            <a href="My_Profile">
              <li>Profile</li>
            </a>
            <a href="courses">
              <li>My Course</li>
            </a>
            <a href="Attendance">
              <li>Attandance</li>
            </a>
            <a href="feeCalculation">
              <li>Fee Calculation</li>
            </a>
            <a href="Teacher_Profile">
              <li>Teacher Assigned</li>
            </a>
            <a href="General_Knowledge">
              <li>General Knowledge</li>
            </a>
            <a href="Testseries?id={{Session()->get('user_id')}}">
              <li>Test Series</li>
            </a>
            <a href="progress">
              <li>Progress report</li>
            </a>
            <a href="Notice?id={{Session()->get('user_id')}}">
              <li>Notice</li>
            </a>
            <a href="Student_doubt?id={{Session()->get('user_id')}}">
              <li>Student Doubts</li>
            </a>
          </ul>
        <?php
        }
        ?>
        <a href="">
          <li>Terms and conditions</li>
        </a>
        <?php
        if (!Session()->get('mobile')) {
        ?>
          <a href="">
            <li><button class="primary-button">Login</button></li>
          </a>
        <?php
        }
        ?>

        <?php

        if (Session()->has('mobile') || Session()->has('user_id') || Session()->has('role')) {
        ?>
          <a href="logout">
            <li><button class="primary-button">Logout</button></li>
          </a>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</div>
<!-- navbar adjuster -->
<div class="navbar-adjuster"></div>