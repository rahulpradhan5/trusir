@extends('layout.layout')
@section('content')
<?php
if (!Session()->has('amount')) {
    echo "<script>loaction.href='/'</script>";
}
?>
<div class="payment-section margin-t30">
    <div class="section">
        <div class="row justify-content-center align-items-center ">
            <h2 class="text-center">Payment</h2>
            <form action="payment" method="post" id="studenForm">
                @csrf

                <div class="col-sm-12">
                    <div class="text-center">
                        <?php
                        if (Session()->get('payment_type') == 'Add course') {
                        ?>
                            <h1 class="registrtionfee registermargbottom" id="fee">
                                {{Session()->get('amount')}}/- Course Fee
                            </h1>
                        <?php
                        } else if (Session()->get('payment_type') == 'student registration') {
                        ?>
                            <h1 class="registrtionfee registermargbottom" id="fee">
                                {{Session()->get('amount')}}/- Registration Fee
                            </h1>
                        <?php
                        } else if (Session()->get('payment_type') == 'teacher registration') {
                        ?>
                            <h1 class="registrtionfee registermargbottom" id="fee">
                                {{Session()->get('amount')}}/- Registration Fee
                            </h1>
                        <?php
                        }
                        ?>


                    </div>
                    <div class="flex align-center j-center width100 margin-t40">
                        <button type="submit" class="secondary-button" id="pay" style="width: 30%;">Pay</button>
                    </div>
                </div>
                <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('API_KEY') }}" data-amount="{{Session()->get('amount') * 100}} " data-theme.color="#ff7529">
                </script>

                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            </form>
        </div>
    </div>
    <div class="capta" id="capta" style="margin-top: 20px;"></div>
    <!-- HTML Form for Payment -->

    <script>
        window.onload = function() {
            $("#pay").click();
        }
    </script>

    @endsection