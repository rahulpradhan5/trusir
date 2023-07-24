@extends('layout.layout')
@section('content')

<!-- attandence -->
<div class="attandance margin-t30">
    <div class="section">
        <div class="heading">
            Attandance
        </div>
        <?php
        if (count($attendance) == 0) {
        ?>
            <h2 class=" margin-t30 text-center width100"> Teacher Will assign you soon</h2>

    </div>
<?php
        } else {

?>
    <div class="courses margin-t30 flex j-center width100">
        <div class="courses-adjuster flex align-center gap50">
            <?php
            $collection = collect($attendance);
            $firstKey = $collection->keys()->first();
            ?>
            <input type="hidden" id="subjectName" value="{{$firstKey}}">
            <?php
            foreach (array_keys($attendance) as $course) {
            ?>

                <button class="third-button <?php if ($firstKey == $course) {
                                                echo "button-active";
                                            } ?>" id="subject{{$course}}" onclick="subjectChanger('{{$course}}') ">{{$course}}</button>

            <?php
            }
            ?>

        </div>
    </div>
    <div class="two-section margin-t30">
        <div class="left-section">
            <div id="calendar" class="calendar">
                <div class="header flex align-center j-center gap50">
                    <button id="prev-btn">&lt;</button>
                    <h3 id="month-year"></h3>
                    <button id="next-btn">&gt;</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
        </div>
        <div class="right-section">

            <div class="flex-colomn gap20">
                <div class="heading">
                    Overview
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus teacher-attand" id="classtaken">{{collect($attendance[$firstKey])->filter(function ($item) { return $item->techer_attend === 'yes'; })->count()}}</div>
                    <h3>Total Class taken</h3>
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus teacher-absent" id="absent">{{collect($attendance[$firstKey])->filter(function ($item) {
                            return ( ($item->techer_attend === 'no' || $item->student_attend === 'no') && $item->isHolyday === 'no' && $item->isSunday === 'no' && $item->isSecondSaturday === 'no' && $item->isFourtSaturday === 'no' ); })->count() }}
                    </div>
                    <h3>Total Absent</h3>
                </div>
                <div class="flex align-center gap10 calendarRight">
                    <div class="calenderstatus holiday" id="holiday">{{collect($attendance[$firstKey])->filter(function ($item) {
                            return $item->isHolyday === 'yes';
                            })->count() + collect($attendance[$firstKey])->filter(function ($item) {
                            return $item->isSunday === 'yes';
                            })->count() + collect($attendance[$firstKey])->filter(function ($item) {
                            return $item->isSecondSaturday === 'yes';
                            })->count() + collect($attendance[$firstKey])->filter(function ($item) {
                            return $item->	isFourtSaturday === 'yes';
                            })->count()}}</div>
                    <h3>Total Holiday</h3>
                </div>
            </div>
        </div>
    </div>
<?php
        }
?>
</div>
</div>
<input type="hidden" id="student_id" value="<?php
                                            if (Session()->get('role') == "student") {
                                                echo Session()->get('user_id');
                                            } else {
                                                echo $_GET['id'];
                                            }

                                            ?>">
<?php
if (count($attendance) > 0) {
?>
    <script>
        var role = "<?php echo Session()->get('role'); ?>"
        // calenderArrow();
        var attandanceData = " {{$attendance[$firstKey]}}";

        function decodeEntities(encodedString) {
            var textarea = document.createElement('textarea');
            textarea.innerHTML = encodedString;
            return textarea.value;
        }

        // Decode HTML entities and parse as JSON
        var decodedArray = JSON.parse(decodeEntities(attandanceData));
        console.log(decodedArray);

        function subjectChanger(subjectName) {
            const buttons = document.querySelectorAll(".third-button"); // Select all elements with the ID "third-button"

            buttons.forEach(button => {
                button.classList.remove("button-active"); // Replace "className" with the class name you want to remove
            });
            document.getElementById("subjectName").value = subjectName;
            document.getElementById("subject" + subjectName).classList.add("button-active");
            var currentDate = new Date();
            var currentMonth = currentDate.getMonth();
            var currentYear = currentDate.getFullYear();

            loadMonthData(currentMonth, currentYear);
        }
    </script>
<?php
}
?>
@endsection