@extends('layout.layout')
@section('content')
<!-- banner slide-->
<div class="slider-banner section">
  <section class="splide">
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        foreach ($bannerslider as $slider) {
        ?>
          <li class="splide__slide"><img src="{{$slider->sliderImage}}" alt=""></li>
        <?php
        }
        ?>
      </ul>
    </div>
  </section>
</div>
<!-- banner -->
<div class="banner-sec ">
  <div class="section">
    <div class="two-section margin-t20 flex align-center j-between">
      <div class="left-section">
        <div class="banner-content flex-colomn align-center j-center text-center">
          <div class=" banner-content-adjuster banner-content flex-colomn  j-center gap10">
            <h1>Welcome To <span class="p-secondary">Trusir</span> </h1>
            <p><span class="p-secondary">Trusir</span> is a registered and trusted Indian company that offers
              Home
              to
              Home tuition service. We have a clear vision of helping students achieve
              their academic goals through one-to-one teaching.</p>
            <div class="banner-btn flex align-center width100 gap50">
              <?php
              if (Session()->has('mobile')) {
              ?>
                <button class="primary-button" onclick="popupopen('studnetEnq')">Student Enquiry</button>
                <button class="primary-button" onclick="popupopen('teacherEnq')">Teacher Enquiry</button>
              <?php
              } else {
              ?>

                <a href="Login?path=studnetEnq"> <button class="primary-button">Student Enquiry</button></a>
                <a href="Login?path=teacherEnq"> <button class="primary-button">Teacher Enquiry</button></a>
              <?php
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <div class="right-section ">
        <img src="images/hometution5.png" alt="">
      </div>
    </div>
  </div>

  <!-- <section class="splide">
    <div class="splide__track">
      <ul class="splide__list">
        <li class="splide__slide"><img src="image/banner.jpeg" alt=""></li>
        <li class="splide__slide"><img src="images/bannerimage.png" alt=""></li>
        <li class="splide__slide"><img src="images/bannerimage.png" alt=""></li>
      </ul>
    </div>
  </section> -->
  <!-- <div class="banner-overlay">
    <div class="banner-content flex-colomn align-center j-center text-center">
      <div class=" section banner-content-adjuster anner-content flex-colomn align-center j-center text-center gap10">
        <h1>Welcome To <span class="p-secondary">Trusir</span> </h1>
        <p><span class="p-secondary">Trusir</span> is a registered and trusted Indian company that offers
          Home
          to
          Home tuition service. We have a clear vision of helping students achieve
          their academic goals through one-to-one teaching.</p>
        <div class="banner-btn flex align-center j-center gap50">
          <button class="primary-button" onclick="popupopen('studnetEnq')">Student Enquiry</button>
          <button class="primary-button" onclick="popupopen('teacherEnq')">Teacher Enquiry</button>
        </div>
      </div>
    </div>
  </div> -->
</div>
<!-- What we Offering -->
<div class="we-are-offering margin-t30">
  <div class="section">
    <div class="heading">
      <img src="images/star.svg" alt="">
      What we Offering
    </div>
    <!-- slider section -->
    <div class="slider margin-t30">
      <section class="splide2 splide">
        <div class="splide__track">
          <ul class="splide__list">
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Free Trial</h3>
                  <p class="margin-t10 p-light">"Unleash your potential with our 5-day free trial.
                    Experience our best
                    features, no commitment."</p>
                </div>
              </div>
            </li>
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Home Tuition</h3>
                  <p class="margin-t10 p-light">"Transforming education, one home at a time.
                    Personalized home tutoring for optimal learning."</p>
                </div>
              </div>
            </li>
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Teachers</h3>
                  <p class="margin-t10 p-light">"Unlock the power of experience. Learn from
                    seasoned teachers who bring knowledge and expertise to the forefront."</p>
                </div>
              </div>
            </li>
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Monthly test</h3>
                  <p class="margin-t10 p-light">"Track your progress, elevate your performance.
                    Monthly tests for continuous growth."</p>
                </div>
              </div>
            </li>
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Free Trial</h3>
                  <p class="margin-t10 p-light">"Unleash your potential with our 5-day free trial.
                    Experience our best
                    features, no commitment."</p>
                </div>
              </div>
            </li>
            <li class="splide__slide">
              <div class="offer-section">
                <img src="images/free-dollar-bag-euro-svgrepo-com 1.svg" alt="">
                <div class="content margin-t30">
                  <h3>Free Trial</h3>
                  <p class="margin-t10 p-light">"Unleash your potential with our 5-day free trial.
                    Experience our best
                    features, no commitment."</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="progress-arrow flex align-center j-between  margin-t30">
          <!-- progress bar -->
          <div class="my-slider-progress ">
            <div class="my-slider-progress-bar"></div>
          </div>
          <!-- custom arrows -->
          <div class=" arrow flex gap20 align-center j-center">
            <img src="images/prevarrow.svg" alt="">
            <img src="images/nextarrow.svg" alt="">
          </div>

        </div>

      </section>
    </div>
  </div>
</div>
<!-- about us -->
<div class="about-us margin-t30">
  <div class="section">
    <div class="section margin-t30">
      <div class="two-section ">
        <div class="left-section">
          <div class="heading">
            <img src="images/star.svg" alt="">
            About us
          </div>
          <p class="margin-t30">
            We offer personalized home-to-home tuition services,
            bringing expert tutors right to your doorstep. Our goal is to
            provide convenient and effective educational support tailored
            to meet your specific needs. Whether you're a student seeking
            extra assistance or a parent looking for quality tutoring for your
            child, our team of highly qualified tutors is here to help.
          </p>

        </div>
        <div class="right-section">
          <img src="images/about_us.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- how it works -->
<div class="how-it-works margin-t30">
  <div class="section">
    <div class="two-section">
      <div class="left-section">
        <img src="images/howitworks.png" alt="">
      </div>
      <div class="right-section">
        <div class="heading">
          <img src="images/star.svg" alt="">
          How it works
        </div>
        <div class="margin-t30 flex-colomn gap10">
          <div class="work-tab">
            <div class="flex j-between align-center">
              <h3>Enquiry</h3>
              <img class="rotateimg rotate1 rotate45" src="images/plus.svg" alt="" onclick=" rotate(1)">
            </div>
            <div class="margin-t10 work-content work-content1">
              <p>Home-to-home tuition offers personalized and convenient educational support
                by bringing qualified tutors directly to your home. With individualized attention,
                tailored learning plans, and flexible scheduling, home tuition ensures a focused
                and effective learning experience.</p>
            </div>
          </div>
          <div class="work-tab">
            <div class="flex j-between align-center">
              <h3>Registartions</h3>
              <img class="rotateimg rotate2" src="images/plus.svg" alt="" onclick=" rotate(2)">
            </div>
            <div class="margin-t10  d-none work-content work-content2">
              <p>Registrations refers to the process of signing up or enrolling individuals for a
                particular event, program, or membership. It involves collecting necessary
                information, such as personal details and preferences, to create a record and allow
                participation or access to the desired service or opportunity.</p>
            </div>
          </div>
          <div class="work-tab">
            <div class="flex j-between align-center">
              <h3>Get tutor</h3>
              <img class="rotateimg rotate3" src="images/plus.svg" alt="" onclick=" rotate(3)">
            </div>
            <div class="margin-t10 d-none work-content work-content3">
              <p>"Get tutor" refers to the process of finding and hiring a qualified instructor or
                mentor for personalized educational guidance. It involves searching for tutors based
                on specific subjects or skills, evaluating their qualifications and experience, and
                engaging their services to receive individualized instruction and support to enhance
                learning and academic performance.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- testimonials -->
<div class="testimonials margin-t30">
  <div class="section">
    <div class="flex align-center j-between flex-wrap gap30">
      <div class="heading">
        <img src="images/star.svg" alt="">
        Testimonials
      </div>
      <!-- custom arrows -->
      <div class="arrow arrow2 flex gap20 align-center j-center">
        <img class="prev-arrow1" src="images/prevarrow.svg" alt="">
        <img class="next-arrow1" src="images/nextarrow.svg" alt="">
      </div>
    </div>
    <div class="margin-t30">
      <section class="splide splide3">
        <div class="splide__track">
          <ul class="splide__list">
            <?php
            foreach ($testimonial as $testi) {
            ?>
              <li class="splide__slide">
                <div class="testi-div">
                  <img src="{{$testi->img}}" alt="">
                  <div class="testi-content">
                    <h3>{{$testi->name}}</h3>
                    <p class="margin-t10">{{$testi->description}}</p>
                  </div>
                </div>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- Available Classes -->
<div class="available-class margin-t30">
  <div class="section">
    <div class="heading">
      <img src="images/star.svg" alt="">
      Available Classes
    </div>
    <div class="srollable-div flex margin-t30 gap30 align-center" id="scrollableContainer">
      <?php
      foreach ($classes as $class) {

      ?>
        <button class="third-button">Class {{$class->class_name}}th</button>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<!-- Available Classes -->
<div class="available-class margin-t30">
  <div class="section">
    <div class="heading">
      <img src="images/star.svg" alt="">
      Available Subject
    </div>
    <div class="srollable-div flex margin-t30 gap30 align-center" id="scrollableContainer2">
      <?php
      foreach ($subjects as $class) {
      ?>
        <button class="third-button">{{$class->subject_name}}</button>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<!-- popups -->

<div id="studnetEnq" class="popup">
  <div class="popup-content flex-colomn align-center j-center gap30">
    <div class="header flex align-center j-between gap50">
      <h2>Student Enquiry</h2>
      <span class="close" onclick="popupclose('studnetEnq')">&times;</span>
    </div>
    <form id="myForm" class="flex-colomn align-center j-center gap20">
      <div class="form-div">
        <label for="">Name</label>
        <input type="text" name="name" id="su_name" placeholder="Enter your name">
      </div>
      <div class="form-div">
        <label for="">Class</label>
        <input type="text" name="class" id="su_class" placeholder="Enter your class">
      </div>
      <div class="form-div">
        <label for="">City</label>
        <input type="text" name="city" id="su_city" placeholder="Enter your city">
      </div>
      <div class="form-div">
        <label for="">Pincode</label>
        <input type="number" name="pincode" id="su_pincode" placeholder="Ex 404230">
      </div>
      <button type="button" class="secondary-button" onclick="studendtEnq()" id="se_submit">Submit</button>
    </form>
  </div>
</div>
<!-- teacher popup -->
<div id="teacherEnq" class="popup">
  <div class="popup-content flex-colomn width100 align-center j-center gap30">
    <div class="header flex align-center j-between gap50">
      <h2>Teacher Enquiry</h2>
      <span class="close" onclick="popupclose('teacherEnq')">&times;</span>
    </div>
    <form id="myForm" class="flex-colomn align-center j-center gap20">
      <div class="form-div">
        <label for="">Name</label>
        <input type="text" name="te_name" id="te_name" placeholder="Enter your name">
      </div>
      <div class="form-div">
        <label for="">Gender</label>
        <select name="te_gen" id="te_gen" placeholder="Ex +91789455659">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Othres">Othres</option>
        </select>
      </div>
      <div class="form-div">
        <label for="">Qualification</label>
        <input type="text" name="te_quali" id="te_quali" placeholder="Enter your qualifiaction">
      </div>
      <div class="form-div">
        <label for="">Class</label>
        <input type="text" name="te_class" id="te_class" placeholder="Enter your cit">
      </div>
      <div class="form-div">
        <label for="">City</label>
        <input type="text" name="te_city" id="te_city" placeholder="Enter your cit">
      </div>
      <div class="form-div">
        <label for="">Pincode</label>
        <input type="number" name="te_pincode" id="te_pincode" placeholder="Enter your pincode">
      </div>
      <button type="button" class="secondary-button" id="te_submit" onclick="teacherEnq()">Submit</button>
    </form>
  </div>
</div>
<script>
  function studendtEnq() {

    var name = document.getElementById("su_name").value;
    var se_class = document.getElementById("su_class").value;
    var city = document.getElementById("su_city").value;
    var pincode = document.getElementById("su_pincode").value;

    if (name == "" || se_class == "" || city == "" || pincode == "") {
      alert("Fill all the fields");
    } else {
      $.ajax({
        url: "{{route('student_enq')}}",
        data: {
          name: name,
          se_class: se_class,
          city: city,
          pincode: pincode,

        },
        type: 'get',
        beforeSend: function() {
          $("#se_submit").attr('disabled', 'disabled');
          $("#se_submit").html('Sending...');
        },
        success: function(data) {
          if (data == "success") {
            $("#se_submit").removeAttr('disabled', 'disabled');
            $("#se_submit").html('Send Enquiry');
            alert("Request Sent Succesfully");
            name.value = "";
            se_class.value = "";
            city.value = "";
            city.value = "";
            pincode.value = "";
            location.href = '/';
            popupclose('studnetEnq')
          } else {
            alert(data);
          }
        }

      })
    }

  }

  function teacherEnq() {

    var name = document.getElementById("te_name").value;
    var gen = document.getElementById("te_gen").value;
    var classs = document.getElementById("te_class").value;
    var te_quali = document.getElementById("te_quali").value;
    var city = document.getElementById("te_city").value;
    var pincode = document.getElementById("te_pincode").value;

    if (name == "" || gen == "" || te_quali == "" || city == "" || pincode == "") {
      alert("Fill all the fields");
    } else {
      $.ajax({
        url: "{{route('teacher_enq')}}",
        data: {
          name: name,
          gen: gen,
          class:classs,
          te_quali: te_quali,
          city: city,
          pincode: pincode,

        },
        type: 'get',
        beforeSend: function() {
          $("#te_submit").attr('disabled', 'disabled');
          $("#te_submit").html('Sending...');
        },
        success: function(data) {
          if (data == "success") {

            $("#te_submit").removeAttr('disabled', 'disabled');
            $("#te_submit").html('Send Enquiry');
            alert("Request Sent Succesfully");
            name.value = "";
            se_class.value = "";
            city.value = "";
            city.value = "";
            pincode.value = "";
            location.href = "/";
            popupclose('teacherEnq')
          } else {
            alert(data);
          }
        }

      })
    }

  }
</script>
@endsection