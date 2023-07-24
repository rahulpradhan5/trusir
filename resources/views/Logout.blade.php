@extends('layout.layout')
@section('content')



 <!-- navbar start -->
 <div class="container text-center vh-100">
        <div class="row ">
            <div class="col-lg-6 align-items-center justify-content-center d-flex ">

                <div class="text-center">
                    <img src="{{ asset('image/Pensive_girl.png')}}" alt="Girl in a jacket" width="100%"
                        height="100%" class="serimg">

                </div>
            </div>
            <div class="col-lg-6 align-items-center mt-5">
                <div class="">
                    <div class="justify-content-center align-items-center">
                        <div class="col-lg-6 align-items-center">
                            <div class="">
                                <div class="">
                                    <div class="text-center">
                                        <img src="{{ asset('image/Diksha_img.png')}}" alt="Girl in a jacket" >
                                    </div>
                                </div>
                                <div>
                                    <p class="textlog">Are you sure you want to Logout?</p>
                                    <br><br>
                                </div>
                                <div>

                                </div>
                                <div>
                                    <button class="cancelbtn">Cancel</button>
                                </div>
                                <div>
                                   <a href="/logout"> <button class="SUBbtn">Log Out</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    </div>



@endsection