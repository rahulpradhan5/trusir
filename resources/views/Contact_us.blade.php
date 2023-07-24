@extends('layout.layout')
@section('content')
<!-- navbar end -->
<!-- login -->
<div class="login margin-t30">
    <div class="section">
        <div class="two-section">
            <div class="left-section">
                <form action="" class="flex-colomn  j-center gap20 margin-t30">
                    <h1>Contact us</h1>
                    <!-- <p class="p-text">OTP will be sent to your mobile number</p> -->
                    <div class="form-div">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-div">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-div">
                        <label for="">Message</label>
                        <textarea type="test" name="message" id="message" placeholder="Wrire your query here.."></textarea>
                    </div>
                    <div class="form-div flex align-center j-center">
                        <button class="secondary-button" type="button" id="contactsub">
                            <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="loader">
                                <div class="ldio-55p6nv4e0l2">
                                    <div></div>
                                </div>
                            </div><span id="btntext">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="right-section">
                <section class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide"><img src="images/bannerimage.png" alt=""></li>
                            <li class="splide__slide"><img src="images/bannerimage.png" alt=""></li>
                            <li class="splide__slide"><img src="images/bannerimage.png" alt=""></li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>



<script>
    $("#contactsub").on('click', function() {
        $.ajax({
            url: "{{route('mail')}}",
            type: 'get',
            data: {
                name: $("#name").val(),
                email: $("#email").val(),
                message: $("#message").val()
            },
            beforeSend: function() {
                $("#contactsub").attr("disabled", "disabled");
                $("#loader").removeClass('d-none');
                $("#btntext").html("sending....");
            },
            success: function(data) {
                if (data == "success") {
                    document.getElementById("name").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("message").value = "";
                    $("#contactsub").removeAttr("disabled", "disabled");
                    $("#btntext").html("Submit");
                    $("#loader").addClass('d-none');
                    $("#alert").html("Sent Successfully");
                    $("#alert").css("display", "flex");
                    $("#alert").css("background-color", "green");
                    setTimeout(function() {
                        $("#alert").css("display", "none");
                    }, 3000)
                } else {
                    $("#contactsub").removeAttr("disabled", "disabled");
                    $("#btntext").html("Submit");
                    $("#loader").addClass('d-none');
                    $("#alert").css("display", "flex");
                    $("#alert").css("background-color", "red");
                    $("#alert").html("Failed ! Try again");
                    setTimeout(function() {
                        $("#alert").css("display", "none");
                    }, 3000)
                }
            },
            error: function() {
                $("#contactsub").removeAttr("disabled", "disabled");
                $("#contactsub").html("Submit");
                $("#alert").css("display", "flex");
                $("#alert").css("background-color", "red");
                $("#alert").html("Failed ! Try again");
                setTimeout(function() {
                    $("#alert").css("display", "none");
                }, 3000)
            }
        })
    })
</script>
@endsection