@extends('layout.layout')
@section('content')
<style>
    .login_center {
        position: relative !important;
        top: 20% !important;
    }

    .row {
        margin-left: 0px !important;
    }

    .container-fluid {
        padding-left: 0px !important;
    }

    .margin_t {
        margin-top: 10%;
    }

    @media(max-width:768px) {
        .login_center {
            position: relative !important;
            top: 0% !important;
        }

        .row_flex {
            flex-direction: column-reverse !important;
        }

        .margin_t {
            margin-top: 20%;
        }
    }
</style>
<?php
if (isset($message)) {
?>
    <div class="alert" style="position:absolute;
    width:300px;
    padding:10px;
    color:#fff;
    background-color:red;display:flex;text-align:start;top:80px;right:0;
    z-index:100;">{{$message}}</div>
<?php
}
?>
<!-- login -->
<div class="login margin-t30">
    <div class="section">
        <div class="two-section">
            <div class="left-section">
                <form action="" class="flex-colomn  j-center gap30 margin-t30">
                    <h1>Login</h1>
                    <p class="p-text">OTP will be sent to your mobile number</p>
                    <div class="form-div">
                        <label for="">Mobile Number</label>
                        <input type="tel" id="number" name="number" id="number" placeholder="Ex +91789455659">
                    </div>
                    <div class="form-div flex align-center j-center">
                        <button type="button" class="secondary-button" onclick="sendCode()" id="login-btn">
                            <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="loader">
                                <div class="ldio-55p6nv4e0l2">
                                    <div></div>
                                </div>
                            </div>Login
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

@endsection