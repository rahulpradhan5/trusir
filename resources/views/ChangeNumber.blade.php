@extends('layout.layout')
@section('content')
<style>
    @media(max-width:768px) {
        .margin_t {
            margin-top: 20% !important;
        }
    }
</style>
<!-- nav bar starts -->

<!-- nav bar end -->
<h2 class="text-center test_heading my-5">Courses</h2>
< <div class="container-fluid text-center mb-4">
    <div class="row">
        <div class="col-lg-12">
            <div class=" text-center mb-5 mt-5">
                <h1 class="loghead">Enter Moblie Number</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-lg-6">
            <div class="justify-content-center align-items-center d-grid" style="margin-bottom: 40px;">
                <div class=" text-start">
                    <h1 class="changenumbertext">Enter Moblie Number</h1>
                </div>
                <div class="justify-content-center align-items-center">

                    <div class="inputnumber">
                        <div class="d-flex">

                            <img src="{{ asset('image/india.png')}}" alt="Girl in a jacket" width="" height="" class="indimg">
                            <span class="align-items-center mx-3 margin_t"> +91 </span>
                        </div>
                        <div class="">
                            <input class="numdiv" type="number" name="search" placeholder="0000000000" id="number">
                        </div>
                    </div>
                    </br></br>
                    <button class="logbtn mb-5" id="sendotp" onclick="sendotp()">Send OTP</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="justify-content-center align-items-center d-grid" style="margin-bottom: 40px;">
                <div class=" text-start">
                    <h1 class="changenumbertext">Enter OTP</h1>
                </div>
                <div class="justify-content-center align-items-center">

                    <div class="otpnumber">

                        <div class="">
                            <input class="inputotp" type="number" id="digit1" min="0" max="9" maxlength="1" size="1" id="fname" name="number1" onkeyup="moveToNext(this, 'digit2')"><br>
                        </div>
                        <div class="">
                            <input class="inputotp" id="digit2" type="number" min="0" max="9" maxlength="1" size="1" name="number2" onkeyup="moveToNext(this, 'digit3')"><br>
                        </div>
                        <div class="">
                            <input class="inputotp" id="digit3" type="number" min="0" max="9" maxlength="1" size="1" name="number3" onkeyup="moveToNext(this, 'digit4')"><br>
                        </div>
                        <div class="">
                            <input class="inputotp" id="digit4" type="number" min="0" max="9" maxlength="1" size="1" name="number4"><br>
                        </div>
                    </div>


                    </br></br>

                    <button class="logbtn mb-5" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="verifyotp()" id="changeotp">Verify OTP</button>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function moveToNext(input, nextFieldID) {
            if (input.value.length >= input.maxLength) {
                document.getElementById(nextFieldID).focus();
            }
        }

        function sendotp() {
            var number = $("#number").val();
            if (number == "") {
                alert("Enter the mobile number")
            } else {
                $.ajax({
                    url: '{{route("NumberChange")}}',
                    data: {
                        number: number,
                    },
                    type: 'get',
                    beforeSend: function() {
                        $("#sendotp").attr("disabled", "disabled");
                        $("#sendotp").html("Sending...")
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == "success") {
                            $("#sendotp").removeAttr("disabled", "disabled");
                            $("#sendotp").html("Send Otp")
                            alert("Otp Sent");
                        } else {
                            $("#sendotp").removeAttr("disabled", "disabled");
                            $("#sendotp").html("Send Otp");
                            alert("Failed");
                        }
                    }
                })
            }

        }

        function verifyotp() {
            var number = $("#number").val();
            var digit1 = $("#digit1").val();
            var digit2 = $("#digit2").val();
            var digit3 = $("#digit3").val();
            var digit4 = $("#digit4").val();

            if (number == "") {
                alert("Enter the mobile number")
            } else {
                if (digit1 == "" || digit2 == "" || digit3 == "" || digit4 == "") {
                    alert("Enter Otp First");
                } else {
                    var otp = digit1 + digit2 + digit3 + digit4;
                    $.ajax({
                        url: "{{route('changeOtp')}}",
                        data: {
                            number: number,
                            otp: otp
                        },
                        type: "get",
                        beforeSend: function() {
                            $("#changeotp").attr("disabled", "disabled");
                            $("#changeotp").html("Verifying...");
                        },
                        success: function(data) {
                            if (data == "success") {
                                $("#changeotp").removeAttr("disabled", "disabled");
                                $("#changeotp").html("Verify Otp");
                                alert('Number Updated');
                            } else {
                                $("#changeotp").removeAttr("disabled", "disabled");
                                $("#changeotp").html("Verify Otp");
                                alert(data);
                            }
                        }
                    })
                }
            }
        }
    </script>

    @endsection