@extends('layout.layout')
@section('content')


<?php
if (isset($message)) {
    if ($message == 'Verified' || $message == 'Otp Sent') {
?>
        <div class="alert" style="position:absolute;
    width:300px;
    padding:10px;
    color:#fff;
    background-color:green;display:flex;text-align:start;top:80px;right:0;
    z-index:100;">{{$message}}</div>
    <?php
    } else {
    ?>
        <div class="alert" style="position:absolute;
    width:300px;
    padding:10px;
    color:#fff;
    background-color:red;display:flex;text-align:start;top:80px;right:0;
    z-index:100;">{{$message}}</div>
<?php

    }
}
?>

<input type="hidden" value="{{$count}}" id="otpCount">


<!-- otp -->
<div class="login margin-t30">
    <div class="section">
        <div class="two-section">
            <div class="left-section">
                <form action="" class="flex-colomn  j-center gap30 margin-t30">
                    <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
                    <h1>Vrify Otp</h1>
                    <p class="p-text">Check Mobile for otp</p>
                    <div class="form-div">
                        <label for="">Otp</label>
                        <input type="tel" name="otp" id="otp" placeholder="Ex 420222">
                    </div>
                    <div class="form-div flex align-center j-center">
                        <button type="button" class="secondary-button" onclick="verifyCode()" id="verify-btn"><div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="loader">
                                <div class="ldio-55p6nv4e0l2">
                                    <div></div>
                                </div>
                            </div>Verify</button>
                    </div>
                    <div class="form-div flex align-center j-center">
                        <p onclick="resendCode()">Resend Otp <span id="count">({{3 -$count}})</span></p>
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

<!-- scripts code bootstrap -->

<script>
    function moveToNext(input, nextFieldID) {
        if (input.value.length >= input.maxLength) {
            document.getElementById(nextFieldID).focus();
        }
    }

    function check() {
        setTimeout(function() {
            var message = '<?php echo $message; ?>';
            if (message == 'Verified') {
                location.href = "/";
            }

        }, 100);
    }
    check();
</script>
@endsection