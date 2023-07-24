@extends('layout.layout')
@section('content')
<!-- Gk -->
<div class="gk margin-t30">
  <div class="section">
    <div class="tag-section">
      <div class="tag-line">
        <h2 class="p-primary ">Expand your <span class="p-secondary">knowledge</span> </h2>
        <p class="p-light margin-t10">"Explore the world of General Knowledge on our web page, where you can
          enhance your awareness and broaden your understanding of various subjects. From current affairs
          to
          historical facts, dive into a treasure trove of knowledge and empower yourself with valuable
          insights."</p>
      </div>
      <!-- <div class="search-div margin-t40 width100">
        <input type="text" class="search" placeholder="search here...">
        <img src="images/search.svg" alt="">
      </div> -->
    </div>
    <?php
    if (Session()->get('role') == 'teacher' && isset($_GET['id'])) {

    ?>
      <button class="secondary-button float-button" onclick="popupopen('gkupload')"><img src="images/upload.svg" alt="" onclick="popupopen('gkupload')"></button>
    <?php
    }
    ?>
    <!-- latest post section -->
    <div class="post-sections margin-t40">
      <div class="recent-post">
        <h3>Latest post</h3>
        <div class="post-section margin-t20">
          <div class="post-row flex-wrap flex align-center gap30 j-between">
            <?php
            foreach ($newGK as $gks) {
            ?>
              <!-- post card -->
              <div class="post-card flex gap10 " id="gkd{{$gks->id}}">
                <!-- post-image -->
                <?php
                if ($gks->image != "") {
                ?>
                  <div class="post-img">
                    <img src="{{$gks->image}}" alt="">
                  </div>

                <?php
                }
                ?>
                <!-- cancel -->
                <?php
                if ($gks->teacher_id == Session()->get('user_id') && Session()->get('role') == 'teacher') {
                ?>
                  <div class="cancel" onclick="deleteCate('{{ $gks->id}}')">
                    <img src="images/cancel-red.svg" alt="">
                  </div>
                <?php
                }
                ?>
                <!-- post-content -->
                <div class="content flex-colomn gap10">
                  <h3>{{$gks->tittle}}</h3>
                  <div class="flex-colomn">
                    <div class="flex gap10 align-center">
                      <?php
                      if (Session()->get('role') == 'student' && Session()->get('user_id') == $gks->student_id) {
                      ?>
                        <span class="tag">For you</span>
                      <?php
                      }
                      ?>
                      <span class="tag">{{ $gks->category}}</span>
                    </div>
                    <span>Posted at: {{$gks->dt}}</span>
                  </div>
                  <p class="p-primary expand" id="descs{{$gks->id}}">{{$gks->disc}}</p>
                  <span class="read-more width100" id="gks{{$gks->id}}" onclick="readmore('gks{{$gks->id}}','descs{{$gks->id}}')">Read more</span>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!--  post section -->
    <div class="post-sections margin-t40">
      <div class="recent-post">
        <h3>All post</h3>
        <div class="courses margin-t30 flex width100">
          <div class="courses-adjuster flex align-center gap20">
            <button class="third-button button-active" onclick="cateLoad('all')" id="all">All</button>
            <?php
            if (Session()->get('role') == 'student') {
            ?>
              <button class="third-button" onclick="cateLoad('forme') " id="forme">For me</button>
            <?php
            } else if (Session()->get('role') == 'teacher') {
            ?>
              <button class="third-button" onclick="cateLoad('myPost') " id="myPost">My post</button>
            <?php
            }
            foreach ($category as $categorys) {
            ?>
              <button class="third-button" onclick="cateLoad('{{$categorys->category}}')" id="{{$categorys->category}}"> {{$categorys->category}}</button>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="post-section margin-t40">
          <div class="post-row flex-wrap flex-colomn align-center gap30 " id="general">
            <?php
            foreach ($gk as $gks) {
            ?>
              <!-- post card -->
              <div class="post-card flex gap10 " id="gkd{{$gks->id}}">
                <!-- post-image -->
                <?php
                if ($gks->image != "") {
                ?>
                  <div class="post-img">
                    <img src="{{$gks->image}}" alt="">
                  </div>

                <?php
                }
                ?>
                <!-- cancel -->
                <?php
                if ($gks->teacher_id == Session()->get('user_id') && Session()->get('role') == 'teacher') {
                ?>
                  <div class="cancel" onclick="deleteCate('{{ $gks->id}}')">
                    <img src="images/cancel-red.svg" alt="">
                  </div>
                <?php
                }
                ?>
                <!-- post-content -->
                <div class="content flex-colomn gap10">
                  <h3>{{$gks->tittle}}</h3>
                  <div class="flex-colomn">
                    <div class="flex gap10 align-center">
                      <?php
                      if (Session()->get('role') == 'student' && Session()->get('user_id') == $gks->student_id) {
                      ?>
                        <span class="tag">For you</span>
                      <?php
                      }
                      ?>
                      <span class="tag">{{ $gks->category}}</span>
                    </div>
                    <span>Posted at: {{$gks->dt}}</span>
                  </div>
                  <p class="p-primary expand" id="desc{{$gks->id}}">{{$gks->disc}}</p>
                  <span class="read-more width100" id="gk{{$gks->id}}" onclick="readmore('gk{{$gks->id}}','desc{{$gks->id}}')">Read more</span>
                </div>
              </div>
            <?php
            }
            ?>
            <div class=" post-row flex-wrap flex-colomn align-center gap30 load-more" id="loadmore">
              <input type="hidden" id="contentId" value="{{$gk[$gk->count() - 1]->id}}">
            </div>
            <?php
            if (!$gk->count() < 5) {
            ?>
              <div class="flex width100 align-center j-center margin-t30 ">
                <button class="secondary-button flex align-center" id="loadingButton" onclick="loadmore('gkCateload')">
                  <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="loader">
                    <div class="ldio-55p6nv4e0l2">
                      <div></div>
                    </div>
                  </div>
                  <span id="loaderContent">Load more</span>
                </button>
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
<div id="gkupload" class="popup">
  <div class="popup-content flex-colomn align-center j-center gap30">
    <div class="header flex align-center j-between gap50">
      <h2>Upload GK</h2>
      <span class="close" onclick="popupclose('gkupload')">&times;</span>
    </div>
    <form id="myForm" class="flex-colomn align-center j-center gap20">
      @csrf
      <?php
      if (Session()->get('role') == "teacher" && isset($_GET['id'])) {
      ?>
        <input type="hidden" name="student_id" id="student_id" value="{{$_GET['id']}}">
      <?php
      }
      ?>
      <div class="form-div">
        <label for="">Tittle</label>
        <input type="tel" name="tittle" id="tittle" placeholder="Enter the tittle" required="required">
      </div>
      <div class="form-div">
        <label for="">Category</label>
        <input type="tel" name="cate" id="cate" placeholder="Enter category" required="required">
      </div>
      <div class="form-div">
        <label for="">Image <span>(optional)</span></label>
        <input type="file" name="question" id="question">
      </div>
      <div class="form-div">
        <label for="">Discription</label>
        <textarea type="tel" name="description" id="description" placeholder="Share your knowladge.." required="required"></textarea>
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
      url: 'addGk', // Replace with your Laravel route
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
          popupclose("gkupload");
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


  const fileInput = document.getElementById('fileInput');
  const preview = document.getElementById('preview');

  fileInput.addEventListener('change', () => {
    $("#preview-div").css("display", "flex");
    const file = fileInput.files[0];
    const reader = new FileReader();

    if (file.type === 'application/pdf') {
      // If the file is a PDF, display a PDF icon image
      preview.src = '{{asset("image/pdf1.png")}}';
    } else {
      // If the file is an image, display the image preview
      reader.addEventListener('load', () => {
        preview.src = reader.result;
      });

      reader.readAsDataURL(file);
    }
  });




  function cateLoad(catename) {
    $(".third-button").removeClass("button-active");
    $("#" + catename).addClass("button-active");
    $.ajax({
      url: "gkCateload",
      data: {
        catename: catename
      },
      type: 'get',
      success: function(data) {
        console.log(data);
        $("#general").html(data);
      }
    })
  }

  function deleteCate(id) {
    $.ajax({
      url: 'deleteGK',
      data: {
        id: id
      },
      type: 'get',
      success: function(data) {
        if (data == "success") {
          $("#gkd" + id).remove();
        } else {
          alert(data);
        }
      }
    })
  }

  function loadmore(url) {
    var inputElements = document.querySelectorAll("#contentId");
    var lastInputElement = inputElements[inputElements.length - 1];
    var starting = lastInputElement.value;
    var limit = 5;
    $.ajax({
      url: url,
      data: {
        starting: starting,
        limit: limit,
        loadmore: 1
      },
      beforeSend: function() {
        document.getElementById("loader").classList.remove("d-none");
        document.getElementById("loaderContent").innerText = "";
        document.getElementById("loadingButton").setAttribute = "disabled";
      },
      success: function(data) {
        document.getElementById("loader").classList.add("d-none");
        document.getElementById("loadingButton").removeAttribute = "disabled";
        document.getElementById("loaderContent").innerText = "Load more";
        document.getElementById("loadmore").innerHTML = document.getElementById("loadmore").innerHTML + data;
        var inputElements = document.querySelectorAll("#contentId");
        var lastInputElement = inputElements[inputElements.length - 1];
        var starting = lastInputElement.value;
        if (starting == 0) {
          document.getElementById("loaderContent").innerText = "You are at end";
        }
      },
      error: function() {
        document.getElementById("loader").classList.add("d-none");
        document.getElementById("loaderContent").innerText = "You are at end";
      }
    })
  }

  function readmore(clicker, remover) {
    if (document.getElementById(clicker).innerHTML == 'Show less') {
      document.getElementById(clicker).innerHTML = 'Read more';
      document.getElementById(remover).classList.add("expand");
    } else if (document.getElementById(clicker).innerHTML == 'Read more') {
      document.getElementById(clicker).innerHTML = 'Show less';
      document.getElementById(remover).classList.remove("expand");
    }

  }

 
</script>
<!-- Description div End -->

@endsection