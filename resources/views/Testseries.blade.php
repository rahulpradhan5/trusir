@extends('layout.layout')
@section('content')
<!-- Notice -->
<div class="gk margin-t30">
  <div class="section position-relative">
    <!-- latest post section -->
    <div class="post-sections margin-t40">
      <div class="recent-post">
        <div class="heading">
          <img src="images/star.svg" alt="">
          Test series
        </div>
        <button class="secondary-button float-button" onclick="popupopen('testupload')"><img src="images/upload.svg" alt="" onclick="popupopen('testupload')"></button>
        <div class="post-section margin-t20">
          <div class="post-row flex-wrap flex align-center gap30 <?php if ($test->count() >= 4) {
                                                                    echo "j-center";
                                                                  } ?>">
            <div class="adjuster flex-wrap flex align-center gap30 <?php if ($test->count() >= 4) {
                                                                      echo "j-center";
                                                                    } ?>">
                                                                    <?php
                                                                    if($test->count()>0){
                                                                    ?>
              <?php
              foreach ($test as $tests) {
              ?>
                <!-- post card -->
                <div class="post-card post-card-test flex-colomn gap10">
                  <!-- post-content -->
                  <div class="content flex-colomn gap10">
                    <h3>{{$tests->title}}</h3>
                    <span>Course: {{$tests->course_name}}</span>
                    <span>Posted On: {{$tests->dt}}</span>
                    <div class="flex align-center gap10 flex-wrap j-between">
                      <a href="{{$tests->questions}}" download><button class="tag p-primary font-weight-bold ">Dowload Questions</button></a>
                      <a href="{{$tests->answer}}" download><button class="tag p-primary font-weight-bold ">Dowload Answers</button></a>
                    </div>
                  </div>
                </div>
              <?php
              }}else{
                ?>
                 <!-- post card -->
                 <div class="post-card post-card-test flex-colomn gap10">
                  <!-- post-content -->
                  <div class="content flex-colomn gap10">
                    <h3>No test uploaded</h3>
                    
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- popups -->
<div id="testupload" class="popup">
  <div class="popup-content flex-colomn align-center j-center gap30">
    <div class="header flex align-center j-between gap50">
      <h2>Upload test</h2>
      <span class="close" onclick="popupclose('testupload')">&times;</span>
    </div>
    <form id="myForm" class="flex-colomn align-center j-center gap20">
      @csrf
      <?php
      if (Session()->get('role') == "teacher") {
      ?>
        <input type="hidden" name="student_id" id="student_id" value="{{$_GET['id']}}">
      <?php
      }
      ?>
      <div class="form-div">
        <label for="">Test tittle</label>
        <input type="tel" name="title" id="title" placeholder="Enter your name" required="required">
      </div>
      <?php
      if (Session()->get('role') == "student") {
      ?>
        <div class="form-div">
          <label for="">Course</label>
          <select name="course" id="course">
            <?php
            foreach ($course as $courses) {
            ?>
              <option value="{{$courses->id}}">{{$courses->course_name}}</option>
            <?php
            }
            ?>
          </select>
        </div>
      <?php
      }
      ?>
      <div class="form-div">
        <label for="">Questions</label>
        <input type="file" name="question[]" id="question" multiple required="required">
      </div>
      <div class="form-div">
        <label for="">Answers</label>
        <input type="file" name="answers[]" id="answers" multiple required="required">
      </div>
      <button type="submit" class="secondary-button width80" id="upload-btn">Submit</button>
    </form>
  </div>
</div>
<script>
  $("#myForm").on('submit', function(e) {
    e.preventDefault();
    var form = document.getElementById('myForm');
    var formData = new FormData(form);
    var fileInput = document.getElementById('question');
    for (var i = 0; i < fileInput.files.length; i++) {
      var file = fileInput.files[i];
      formData.append('questions[]', file);
    }

    var fileInputans = document.getElementById('answers');
    for (var i = 0; i < fileInputans.files.length; i++) {
      var file = fileInputans.files[i];
      formData.append('answers[]', file);
    }
    $.ajax({
      url: 'testUpload', // Replace with your Laravel route
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener('progress', function(e) {
          if (e.lengthComputable) {
            var percent = Math.round((e.loaded / e.total) * 100);
            $('#upload-btn').html('Uploading (' + percent + '%)');
            $('#upload-btn').attr("disabled", "disabled");
          }
        });
        return xhr;
      },
      success: function(data) {
        if (data == "success") {
          $('#upload-btn').removeAttr("disabled", "disabled");
          $('#upload-btn').html('Upload');
          form.reset();
          popupclose("testupload");
          alert("Test uploaded");
          $("#add-course-form")[0].reset();
          $("#preview").css("display", "none");
          $("#alert").html("Course added successfully");
          $("#alert").addClass("ale-succ");
          setTimeout(function() {
            $("#alert").removeClass("ale-succ");
          }, 3000);

        } else {
          $('#upload-btn').removeAttr("disabled", "disabled");
          $('#upload-btn').html('Upload');
          $("#alert").html("Course added Failed");
          $("#alert").addClass("ale-dan");
          setTimeout(function() {
            $("#alert").removeClass("ale-dan");
          }, 3000);
        }
      },
      error: function(xhr,err) {
        console.log(xhr,err);
        $('#upload-btn').html('Upload');
        alert('Error uploading file: ' + xhr.responseText);
        $('#upload-btn').removeAttr("disabled", "disabled");
        $('#upload-btn').html('Upload');
      }
    });
  })
</script>
@endsection