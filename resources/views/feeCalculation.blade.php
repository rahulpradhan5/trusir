@extends('layout.layout')
@section('content')
<?php
$collection = collect($fees);
$firstKey = $collection->keys()->first();
?>
<div class="section flex-colomn align-center j-center margin-t40 gap30">
    <div class="flex align-center gap30 width80 j-center">
        <div class="flex align-center gap30  scroll-x">
            <?php
            foreach (array_keys($fees) as $fee) {
                $val = "attandance";
                $val1 = "price";
            ?>

                <button class="third-button" onclick="changed(key = '{{$fees[$fee][$val]}}',price='{{$fees[$fee][$val1]}}',heading = '{{$fee}}')">{{$fee}}</button>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="fee-structure flex-colomn align-center j-center gap30">
        <div class="top-section flex-colomn  gap20 width100">
            <div class="flex-colomn gap20 ">
                <div class="heading  width100 text-center align-center j-center" id="heading">
                    {{$firstKey}}
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus teacher-attand" id="classtaken">{{collect($fees[$firstKey]['attandance'])->filter(function ($item) { return $item->techer_attend === 'yes' && $item->student_attend === 'yes'; })->count()}}</div>
                    <h3>Total Class taken</h3>
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus teacher-absent" id="absent">
                        {{collect($fees[$firstKey]['attandance'])->filter(function ($item) {
                            return ( ($item->techer_attend === 'no' || $item->student_attend === 'no') && $item->isHolyday === 'no' && $item->isSunday === 'no' && $item->isSecondSaturday === 'no' && $item->isFourtSaturday === 'no' ); })->count() }}
                    </div>
                    <h3>Total Absent</h3>
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus holiday" id="holiday">{{collect($fees[$firstKey]['attandance'])->filter(function ($item) {
                            return $item->isHolyday === 'yes';
                            })->count() + collect($fees[$firstKey]['attandance'])->filter(function ($item) {
                            return $item->isSunday === 'yes';
                            })->count() + collect($fees[$firstKey]['attandance'])->filter(function ($item) {
                            return $item->isSecondSaturday === 'yes';
                            })->count() + collect($fees[$firstKey]['attandance'])->filter(function ($item) {
                            return $item->isFourtSaturday === 'yes';
                            })->count()}}</div>
                    <h3>Total Holiday</h3>
                </div>
                <div class="flex align-center gap10 j-between width100">
                    <h2>Total fee</h2>
                    <h2 id="price">₹ {{$fees[$firstKey]['price']}}</h2>
                </div>
            </div>
        </div>
        <div class="flex align-center j-center gap20 buttons">
            <a href="Attendance"><button class="primary-button width100"> Check Attendance</button></a>
            <button class="primary-button width100"> Pay now</button>
        </div>
    </div>
</div>
<script>
    function decodeEntities(encodedString) {
        var textarea = document.createElement('textarea');
        textarea.innerHTML = encodedString;
        return textarea.value;
    }

    // Decode HTML entities and parse as JSON


    function changed(key, price, heading) {
        var attandanceData = key;
        var decodedArray = JSON.parse(decodeEntities(attandanceData));
        let attand = decodedArray.filter(function(el) {
            return (el.techer_attend == 'yes' && el.student_attend == 'yes');
        });
        let absent = decodedArray.filter(function(el) {
            return (el.techer_attend == 'no' || el.student_attend == 'no');
        });
        let holiday = decodedArray.filter(function(el) {
            return (el.isHolyday == 'yes' || el.isSunday == 'yes' || el.isSecondSaturday == 'yes' || el.isFourtSaturday == 'yes');
        });
        $("#classtaken").html(attand.length)
        $("#absent").html(absent.length)
        $("#holiday").html(holiday.length)
        $("#price").html('₹ ' + price);
        $("#heading").html(heading);
    }
</script>
@endsection