@extends('layout.layout')
@section('content')
<div class="gk margin-t30">
  <div class="section">
    <!-- latest post section -->
    <div class="post-sections margin-t40">
      <div class="recent-post">
        <div class="flex align-center j-between flex-wrap width100">
          <div class="heading">
            <img src="images/star.svg" alt="">
            Notices
          </div>
          <?php
          if (Session()->get('role') == "teacher") {
          ?>
            <button class="secondary-button float-button" onclick="popupopen('testupload')"><img src="images/upload.svg" alt="" onclick="popupopen('testupload')"></button>
          <?php
          }
          ?>
        </div>
        <div class="post-section margin-t20">
          <div class="post-row flex-wrap flex align-center gap30 j-between">
            <?php
            if ($notice->count() != 0) {
              foreach ($notice as $notices) {
            ?>
                <!-- post card -->
                <div class="post-card flex-colomn gap10" id="noti{{$notices->id}}">
                  <?php
                  if (Session()->get('role') == 'teacher' && $notices->teacher_id == Session()->get('user_id')) {
                  ?>
                    <div class="cancel" onclick="deleteNotice('{{$notices->id}}')">
                      <img src="images/cancel-red.svg" alt="">
                    </div>
                  <?php
                  }
                  ?>
                  <!-- post-content -->
                  <div class="content flex-colomn gap10">
                    <h3>{{$notices->title}}</h3>
                    <p class="p-primary">{{$notices->noticedesc}}</p>
                    <p>
                      <span>Posted On: {{$notices->dt}}</span>
                    </p>
                  </div>
                </div>
              <?php
              }
            } else {
              ?>
              <!-- post card -->
              <div class="post-card flex-colomn gap10">
                <!-- post-content -->
                <div class="content flex-colomn gap10">
                  <h3>No notices</h3>
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
<!-- popups -->
<div id="testupload" class="popup">
  <div class="popup-content flex-colomn align-center j-center gap30 width100">
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
        <input type="text" name="title" id="title" placeholder="Enter your name" required="required">
      </div>
      <div class="form-div">
        <label for="">Discription</label>
        <textarea name="desc" id="desc" required="required" placeholder="Enter about notice.."></textarea>
      </div>
      <button type="submit" class="secondary-button width80" id="upload-btn">Submit</button>
    </form>
  </div>
</div>
<script>
  function deleteNotice(id) {
    $.ajax({
      url: 'deleteNotice',
      type: 'get',
      data: {
        id: id
      },
      success: function(data) {
        if (data == "success") {
          $("#noti" + id).remove();
        } else {
          alert(data);
        }
      }
    })
  }

  $("#myForm").on('submit', function(e) {
    e.preventDefault();
    var form = document.getElementById('myForm');
    var formData = new FormData(form);
    $.ajax({
      url: 'addnotice', // Replace with your Laravel route
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
          alert("Notice added");
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