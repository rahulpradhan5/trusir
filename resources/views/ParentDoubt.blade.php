@extends('layout.layout')
@section('content')
<?php
if(isset($message)){
  echo "<script>alert(".$message.")</script>";
}

?>
<!-- progress start -->
<h2 class="text-center test_heading my-5">Parent Doubts</h2>
<!-- <div class="row progress-month d-flex justify-content-center " > -->
<div class="row px-2">

  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="doubt" method="post" enctype="multipart/form-data" id="doubtForm">
@csrf
      <div class="regiserform ">
        <div class="">
          <input class="numdiv10" type="text" id="email" name="email" placeholder="Email Id" required="required">
        </div>
      </div>
      <div class="regiserform ">
        <div class="">
          <input class="numdiv10" type="text" id="title" name="title" placeholder="Tittle" required="required">
        </div>
      </div>
      <div class="regiserform ">
        <div class="">
          <input class="numdiv10" type="file" id="email" name="aadhar1" placeholder="Email Id" required="required">
        </div>
      </div>
      <div class="contacttextarea">

        <div class="">
          <textarea class=" numdiv10" id="disc" name="disc" rows="" cols="" placeholder="Message" required="required"></textarea>
        </div>

      </div>
  </div>



</div>
</div>



</div>


</div>




</div>

<div class="">
  <h4 class="std-or">OR</h4>
</div>
<div class="container">
  <div class="row d-flex justify-content-center text-center main_doubt parentdoubt-m ">
    <div class="col-md-4 col-sm-12 student_doubt3 text-white ">
      <img src="{{ asset('image/Group 4.svg')}}" height="100px" width="100px" alt="">

      <div class="doubt_name">whatsapp</div>


    </div>

    <div class="col-md-4 student_doubt3 text-white">
      <img src="{{ asset('image/studentdoubt2.png')}}" alt="">

      <div class="doubt_name">Admin</div>

      <div class="doubt_number">+91-9876543210</div>


    </div>
  </div>
</div>

<div>
  <center> <button class="SUBbtn text-center mb-5">Submit</button></center>


</div>
</form>

<!-- <script>

  $("#doubtForm").on("submit",function(e){
    e.preventDefault();
    const form = document.querySelector('#doubtForm');
    var fd = new FormData(form);
    $.ajax({
      url:"{{route('doubt')}}",
      data:{
        email:$("#email").val(),
        title:$("#title").val(),
        disc:$("#disc").val()
      },
      type:'get',
      success:function(data){
        if(data == "success"){
          alert("Doubt Sent");
        }else{
          alert("Failed");
        }
      }
    })
  })
</script> -->
@endsection