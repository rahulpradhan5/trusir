@extends('layout.layout')
@section('content')

<!-- register -->
<div class="registration margin-t30">
    <div class="section flex-colomn gap30">
        <div class="heading width100 text-center j-center " style="white-space: nowrap;">
            <img src="images/star.svg" alt="">
            Teacher Registration
        </div>
        <form action="teacherSubmit" id="teacherSubmit" method="post" enctype="multipart/form-data" class="flex-colomn gap30">
            @csrf
            <!-- student1 -->
            <div class="student flex-colomn gap30" id="formId1">
                <!-- personal details -->
                <h2>Personal Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Teacher Name</label>
                        <input type="text" class="numdiv" required="required" name="studenname1" id="studenname1" placeholder="Enter name">
                    </div>
                    <div class="form-div">
                        <label for="">Father's Name</label>
                        <input type="text" class="numdiv" required="required" name="father1" required="required" id="father1" placeholder="Enter father's name">
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Mother's Name</label>
                        <input type="text" class="numdiv" required="required" name="mother1" required="required" id="mother1" placeholder="Enter mother name">
                    </div>
                    <div class="form-div">
                        <label for="">Gender</label>
                        <Select type="text" class="numdiv" required="required" name="gender1" required="required" id="gender1">
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </Select>
                    </div>
                    <div class="form-div">
                        <label for="">DOB</label>
                        <input type="date" name="dob1" id="dob1" placeholder="Enter student name" required="required">
                    </div>
                </div>
                <!-- personal details -->
                <h2>Study Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">School Name</label>
                        <input class="numdiv" required="required" type="text" id="school1" name="school1" required="required" placeholder="Enter school name">
                    </div>
                    <div class="form-div">
                        <label for="">Medium</label>
                        <select class="numdiv" required="required" id="medium1" name="medium1" required="required">
                            <option value="hindi">Hindi</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Qualification</label>
                        <input type="text" name="qualification" id="qualification" required="required" placeholder="Enter your qualification">
                    </div>
                    <div class="form-div">
                        <label for="">Expirence</label>
                        <input class="numdiv" required="required" type="text" name="exp" id="exp" placeholder="Enter your exp">
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Class</label>
                        <select type="text" class="numdiv" required="required" id="class1" name="class1" required="required">
                            <option value="">Select a class</option>
                            <?php
                            foreach ($class as $classes) {
                            ?>
                                <option value="{{$classes->class_name}}">{{$classes->class_name}}</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">Subjects</label>
                        <select class="numdiv" required="required" id="subject1" name="subject1" required="required">
                            <option value="">Select a subject</option>
                            <?php
                            foreach ($subject as $subjects) {
                            ?>
                                <option value="{{$subjects->subject_name}}">{{$subjects->subject_name}}</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- addres details -->
                <h2>Address Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">State</label>
                        <select type="text" name="state1" id="state1" required="required" oninput="cityload()">
                            <option value="">--Select State--</option>
                            <?php
                            foreach ($states as $state) {
                            ?>
                                <option value="{{$state->name}}" style="text-transform: capitalize;">{{$state->name}}</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">City/town</label>
                        <select type="text" name="city1" id="city1" required="required" oninput="pincodeload()">
                            <option value="">--Select City--</option>
                            <option value="">Select a state first</option>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">Area/Mohalla</label>
                        <input class="numdiv" required="required" type="text" name="area1" id="area1" placeholder="Enter area name">
                    </div>
                    <div class="form-div">
                        <label for="">Pincode</label>
                        <select type="text" name="pincode1" id="pincode1" required="required">
                            <option value="">Select a pincode</option>
                            <option value="">Select a city first</option>
                        </select>
                    </div>
                </div>

                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Permanent address</label>
                        <input class="numdiv" required="required" type="text" name="fulladd1" id="fulladd1" placeholder="Enter area name">
                    </div>
                </div>
                <!-- Upload details -->
                <h2>File uploads</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Profile Image</label>
                        <input class="numdiv" required="required" type="file" name="image1" id="image1">
                    </div>
                    <div class="form-div">
                        <label for="">Aadhar Image</label>
                        <input type="file" class="numdiv" required="required" name="aadhar1" id="aadhar1">
                    </div>
                </div>
                <!-- Upload details -->
                <h2>Slots</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Slots</label>
                        <select class="numdiv slot" name="slots[]" multiple="multiple">
                            <?php
                            foreach ($slots as $slot) {
                            ?>
                                <option value="{{$slot->timing}}">{{$slot->timing}}</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- terms and conditions -->
            <div class="checkbox-container">
                <input type="checkbox" id="myCheckbox" class="hidden-checkbox">
                <label for="myCheckbox" class="checkbox-label"></label>
                <span class="checkbox-text">I agree with <a href="">terms and conditions</a></span>
            </div>
            <!-- register button -->
            <h2 class="text-center">{{$reg[0]->work}}/- Registartion Fee</h2>
            <button type="submit" id="register" class="secondary-button">
                Register
            </button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.slot').select2();
    });

    function showregisterForm() {
        var fee = "{{$reg[0]->work}}";
        var formid = $("#noOfstudent").val();
        $(".numdiv").removeAttr('required', 'required');
        $(".student").removeClass("flex-colomn");
        $(".student").addClass("d-none");
        for (i = 1; i <= formid; i++) {
            $("#formId" + i).removeClass("d-none");
            $("#formId" + i).addClass("flex-colomn");
            $("#studenname" + i).attr('required', 'required');
            $("#gender" + i).attr('required', 'required');
            $("#dob" + i).attr('required', 'required');
            $("#father" + i).attr('required', 'required');
            $("#mother" + i).attr('required', 'required');
            $("#state" + i).attr('required', 'required');
            $("#city" + i).attr('required', 'required');
            $("#area" + i).attr('required', 'required');
            $("#fulladd" + i).attr('required', 'required');
            $("#image" + i).attr('required', 'required');
            $("#aadhar" + i).attr('required', 'required');
            $("#class" + i).attr('required', 'required');
            $("#medium" + i).attr('required', 'required');
            $("#subject" + i).attr('required', 'required');
            $("#school" + i).attr('required', 'required');
            $("#pincode" + i).attr('required', 'required');
            $("#fee").html(parseInt(fee) * i + "/- Registration Fee ");
        }

    }

    function cityload() {
        var state = $("#state1").val();
        $.ajax({
            url: "cityload",
            data: {
                state: state
            },
            type: "get",
            success: function(data) {
                console.log(data);
                da = `<option value="">Select a city</option>`;
                for (var i = 0; i <= data.length - 1; i++) {
                    da = da + `<option value="` + data[i].name + `" style="text-transform: capitalize;">` + data[i].name + `</option>`;
                }
                $("#city1").html(da);
            }
        })
    }

    function pincodeload() {
        var city = $("#city1").val();
        $.ajax({
            url: "pincodeload",
            data: {
                city: city
            },
            type: "get",
            success: function(data) {
                console.log(data);
                da = `<option value="">Select a pincode</option>`;
                if (data.length == 0) {
                    da = da + `<option value="">We are not available in your city</option>`
                } else {
                    for (var i = 0; i <= data.length - 1; i++) {
                        da = da + `<option value="` + data[i].pincode + `" style="text-transform: capitalize;">` + data[i].pincode + `</option>`;
                    }
                }
                $("#pincode1").html(da);
            }
        })
    }

    $("#teacherSubmit").on('submit',function(data){
        $("#register").attr("disabled","disabled")
    })
</script>
@endsection