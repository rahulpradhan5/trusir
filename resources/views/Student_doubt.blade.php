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
          Student doubts
        </div>
        <?php
        if(Session()->get('role') == "student"){
        ?>
        <button class="secondary-button float-button" onclick="popupopen('testupload')"><img src="images/upload.svg" alt="" onclick="popupopen('testupload')"></button>
        <?php
        }
        ?>
        <div class="post-section margin-t20">
          <div class="post-row flex-wrap flex align-center gap30 j-center">
            <div class="adjuster flex-wrap flex align-center gap30 j-center">
              <?php
              if ($doubts->count() > 0) {
              ?>
                <?php
                foreach ($doubts as $tests) {
                ?>
                  <!-- post card -->
                  <div class="post-card  flex-colomn gap10">
                    <!-- post-content -->
                    <div class="content flex-colomn gap10">
                      <h3>{{$tests->tittle}}</h3>
                      <span>Posted On: {{$tests->dt}}</span>
                      <div class="flex align-center gap10 flex-wrap j-between">
                        <p>{{$tests->desc }}</p>
                        <a href="{{$tests->file}}" download><button class="tag p-primary font-weight-bold ">Dowload Doubts</button></a>
                      </div>
                    </div>
                  </div>
                <?php
                }
              } else {
                ?>
                <!-- post card -->
                <div class="post-card post-card-test flex-colomn gap10">
                  <!-- post-content -->
                  <div class="content flex-colomn gap10">
                    <h3>No doubts uploaded</h3>

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
        <label for="">Tittle</label>
        <input type="tel" name="title" id="title" placeholder="Enter your tittle" required="required">
      </div>
      
        <div class="form-div">
          <label for="">Teachers</label>
          <select name="teacher_id" id="teacher_id">
            <?php
            foreach ($teacher as $courses) {
            ?>
              <option value="{{$courses->teacher_id}}">{{$courses->name}}</option>
           
          </select>
        </div>
      <?php
      }
      ?>
      <div class="form-div">
        <label for="">Image</label>
        <input type="file" name="question" id="question"  required="required">
      </div>
      <div class="form-div">
        <label for="">Dicription</label>
        <textarea  name="desc" id="desc"  required="required" placeholder="Enter you doubts..."></textarea>
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
      var file = fileInput.files[0];
      formData.append('file', file);


    $.ajax({
      url: 'uploaddoubt', // Replace with your Laravel route
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
      error: function(xhr) {
        console.log(xhr);
        $('#upload-btn').html('Upload');
        alert('Error uploading file: ' + xhr.responseText);
        $('#upload-btn').removeAttr("disabled", "disabled");
        $('#upload-btn').html('Upload');
      }
    });
  })
</script>
@endsection