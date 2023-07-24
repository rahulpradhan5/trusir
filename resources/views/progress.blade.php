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
          Progress report
        </div>
      
        <div class="post-section margin-t20">
          <div class="post-row flex-wrap flex align-center gap30 <?php if ($progress->count() >= 4) {
                                                                    echo "j-center";
                                                                  } ?>">
            <div class="adjuster flex-wrap flex align-center gap30 <?php if ($progress->count() >= 4) {
                                                                      echo "j-center";
                                                                    } ?>">
                                                                    <?php
                                                                    if($progress->count()>0){
                                                                    ?>
              <?php
              foreach ($progress as $tests) {
              ?>
                <!-- post card -->
                <div class="post-card post-card-test flex-colomn gap10">
                  <!-- post-content -->
                  <div class="content flex-colomn gap10">
                    <h3>{{$tests->dt}}</h3>
                    <div class="flex j-between align-center">
                    <span>Course: {{$tests->course_name}}</span>
                    <span>Marks: {{$tests->obtain_marks}}/{{$tests->total_marks}}</span>
                    </div>
                    <div class="flex align-center gap10 flex-wrap j-between">
                      <a href="{{$tests->file}}" download><button class="tag p-primary font-weight-bold ">Dowload report</button></a>
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


@endsection