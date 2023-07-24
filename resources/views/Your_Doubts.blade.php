@extends('layout.layout')
@section('content')
<!-- navbar end -->

<div class="mt-4 mb-4 text-center">
    <h3 class="student_fac">Your Doubts</h3>
</div>

<!-- Address Div start -->
<div class="p-4">
    <?php 
    
    foreach($doubts as $doubt){
        $dt = \Carbon\Carbon::parse($doubt->dt)->format('jS M Y');
    ?>
    <div class="row  justify-content-center mb-4">
        <div class="col-lg-3 col-md-3">
        </div>
        <div class="col-lg-6 col-md-6  pdfcard mb-4">
            <div class="d-flex " style="align-items: end;">

                <div lass="col-lg-3 col-md-3 ">
                    <img class="mt-4 mx-3 " src="{{ asset('image/pdf.png')}}" alt="">
                </div>
                <div class="col-lg-9 col-md-9">
                    <!-- <h4 class="pt-3 px-1">Mathematics</h4> -->
                    <span class="mx-1">{{ $dt}} </span>
                    <a class="mx-1" href="{{ asset($doubt->file) }}" download>Download</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
        </div>

    </div>
    <?php
    }
    ?>
    <!-- Address Div end -->

</div>
@endsection