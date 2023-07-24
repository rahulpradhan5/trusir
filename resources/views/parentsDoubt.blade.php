@extends('layout.layout')
@section('content')
<div class="mt-4 mb-2 text-center">
  <h3 class="student_fac me-4">Parents Doubts</h3>
</div>
<!-- heading div start -->
<!-- <div class="container">

</div> -->
<!-- heading div End -->

<!-- Description div start -->
<div class="container">
  <!-- 1st row code  -->
  <div class="row ">
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-8 px-5 mb-4">
          <?php
          foreach ($doubts as $doubt) {
            $dt = \Carbon\Carbon::parse($doubt->dt)->format('jS M Y');
          ?>
            <div class="col-lg-8 color_properties px-5 py-4 mb-3" style="display: flex;gap:20px;">
              <?php
              if ($doubt->file != "") {
              ?>
                <a href="{{$doubt->file}}" download="download"><img src="{{$doubt->file}}" alt="" style="height:150px;width:150px;border-radius:10px;"></a>
              <?php
              }
              ?>
              <div>
                <h5><b>{{$doubt->title}} </b></h5>
                <span class=" post_color">Posted On: {{$dt}}</span>
                <p class="mt-1">{{$doubt->disc}}</p>
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
@endsection