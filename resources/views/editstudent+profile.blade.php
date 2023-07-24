@extends('layout.layout')
@section('content')
<div class="mt-4 mb-4 text-center">
    <h3 class="student_fac">Teacher Profile</h3>
</div>

<!-- Address Div start -->
<div class="row ">
    <div class="col-lg-3 col-md-3">
    </div>
    <div class="col-lg-6 col-md-6  disha_back mb-4">
        <div class="d-flex ">

            <div lass="col-lg-3 col-md-3 ">
                <img class="mt-3 mx-5 dish_img" src="{{ asset($teachers[0]->profile_img)}}" alt="" style="width:150px;height:150px;border-radius: 50px;">
            </div>
            <div class="col-lg-9 col-md-9">
                <h4 class="pt-4 px-4 text-white shah_color">{{$teachers[0]->username}} </h4>
                <span class="mx-4 num_info text-white">+91-{{$teachers[0]->mobile}} </span>
            </div>
        </div>

    </div>

    <div class="col-lg-3 col-md-3">
    </div>

</div>
<!-- Address Div end -->

<!-- Profile Page Start -->
<!-- 1 st Row Start -->
<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/36male.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class="pt-1 mx-2 proftext ">{{$teachers[0]->age}}</h4>


                </div>
            </div>

        </div>
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/mumbai.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class="pt-1 mx-2 proftext ">{{$teachers[0]->city}}</h4>
                </div>
            </div>

        </div>
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/BED.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class=" pt-1 mx-2 proftext ">{{$teachers[0]->qualification}}</h4>
                </div>
            </div>

        </div>
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/5yers.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class="pt-1 mx-2 proftext ">{{$teachers[0]->experience}} years of teaching Maths at D.V.P Public School, Mumbai</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/Group4.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class="pt-1 mx-2 proftext mx-2">{{$teachers[0]->skills}}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-5 d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <img class="mx-2 dish_img" src="{{ asset('image/Englishmed.png')}}" alt="">
                </div>
                <div class="profcard mx-2">
                    <h4 class="pt-1 mx-2 proftext mx-2">{{$teachers[0]->medium}}</h4>
                </div>
            </div>
        </div>


        <?php


        if (Session()->get("role") == "teacher" && $teachers[0]->id == Session()->get("user_id")) {
        ?>
            <div class="d-flex justify-content-center mb-4">
                <button class="verifybtn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalteacher">Edit Profile</button>
            </div>
        <?php
        }
        ?>
    </div>

</div>

<!-- popup modal -->
<div class="modal fade mt-5" id="exampleModalteacher" tabindex="-1" aria-labelledby="exampleModalteacher" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body p-5 ">
                <div class="text-center">
                    <form id="editform">
                        <input type="hidden" value="{{$teachers[0]->id}}" name="id">
                        <h1 class="modaltext">Edit Profile</h1>
                        <div class="regiserform">

                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Name</label>
                                <input class="numdiv" type="text" name="name" placeholder="Teacher Name" value="{{$teachers[0]->username}}" id="tname">
                            </div>
                        </div>
                        <div class="regiserform">
                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Age</label>
                                <input class="numdiv" type="number" name="age" placeholder="Age" value="{{$teachers[0]->age}}" id="tage">
                            </div>
                        </div>
                        <div class="regiserform">

                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Qualifiaction</label>
                                <input class="numdiv" type="text" name="quali" placeholder=" Qualification" value="{{$teachers[0]->qualification}}" id="tquali">
                            </div>
                        </div>
                        <div class="regiserform">

                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Exp</label>
                                <input class="numdiv" type="text" name="exp" placeholder="Experience" value="{{$teachers[0]->experience}}" id="texp">
                            </div>
                        </div>
                        <div class="regiserform">

                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Skills</label>
                                <input class="numdiv" type="text" name="skill" placeholder="Skills" value="{{$teachers[0]->skills}}" id="tskills">
                            </div>
                        </div>
                        <div class="regiserform">

                            <div class="" style="text-align: start;">
                                <label for="" style="font-size: 12px;">Medium</label>
                                <input class="numdiv" type="text" name="medium" placeholder="Medium" value="{{$teachers[0]->medium}}" id="tmedium">
                            </div>
                        </div>

                        <div class="regiserform" style="text-overflow: ellipsis;">

                            <div class="" style="text-align: start;text-overflow: ellipsis;overflow: hidden;">
                                <label for="" style="font-size: 12px;">Profile</label>
                                <input class="numdiv" type="file" name="file" placeholder="Student Name" id="fileInput" style="text-overflow: ellipsis;">
                            </div>
                        </div>
                        <div style="width: 100%;display:flex;align-items:flex-start;justify-content:space-between;">
                            <img src="{{ asset($teachers[0]->profile_img)}}" alt="" style="width:100px;height:100px;border-radius:10px;" id="preview">
                        </div>

                        <button class="pop-up-yes mt-5 " id="submit"><span class="text-white">Save</span> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
<script>
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.addEventListener('load', () => {
            preview.src = reader.result;
        });

        reader.readAsDataURL(file);
    });


    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    $(document).ready(function() {
        $('#editform').submit(function(e) {
            e.preventDefault();
            var files = $('#fileInput')[0].files;

            if (files.length > 0) {
                const form = document.querySelector('#editform');
                var fd = new FormData(form);
                fd.append('file', files[0]);
                fd.append('_token', CSRF_TOKEN);
            } else {
                const form = document.querySelector('#editform');
                var fd = new FormData(form);
                fd.append('file', "<?php echo $teachers[0]->profile_img; ?>");
                fd.append('_token', CSRF_TOKEN);
            }

            // AJAX request 
            $.ajax({
                url: "{{ route('editProfileteacher') }}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            // Update the button text or value with the percentage
                            $('#submit').attr("disabled", "disabled");
                            $('#submit').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    if (data == 1) {
                        $('#submit').removeAttr("disabled", "disabled");
                        $('#submit').html('Submit');
                        alert('Profile Updated Relode the page');
                    } else {
                        $('#submit').removeAttr("disabled", "disabled");
                        $('#submit').html('Submit');
                        alert('Failed Try Again');
                    }
                },
            });
        });
    });
</script>
@endsection