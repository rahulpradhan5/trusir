@extends('layout.layout')
@section('content')

<!-- register -->
<div class="registration margin-t30">
    <div class="section flex-colomn gap30">
        <div class="heading width100 text-center j-center " style="white-space: nowrap;">
            <img src="images/star.svg" alt="">
            Student Registation
        </div>
        <form action="StudentSubmit" id="StudentSubmit" method="post" enctype="multipart/form-data" class="flex-colomn gap30">
            @csrf
            <div class="form-row flex align-center j-between gap30">
                <div class="form-div">
                    <label for="">Mobile no</label>
                    <input type="text" name="mobile" name="mobile" placeholder="Ex +91-1011548444" value="{{Session()->get('mobile')}}" readonly required="required">
                </div>
                <div class="form-div">
                    <label for="">No of Students</label>
                    <select name="noOfstudent" id="noOfstudent" onchange="showregisterForm()">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <!-- student1 -->
            <div class="student flex-colomn gap30" id="formId1">
                <h2 class="text-center">Student 1</h2>
                <!-- personal details -->
                <h2>Personal Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Student Name</label>
                        <input type="text" class="numdiv" required="required" name="studenname1" id="studenname1" placeholder="Enter student name">
                    </div>
                    <div class="form-div">
                        <label for="">Father's Name</label>
                        <input type="text" class="numdiv" required="required" name="father1" required="required" id="father1" placeholder="Enter father's name">
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Mother's Name</label>
                        <input type="text" class="numdiv" required="required" name="mother1" required="required" id="mother1" placeholder="Enter student name">
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
                        <label for="">Area/Mohalla</label>
                        <input class="numdiv" required="required" type="text" name="area1" id="area1" placeholder="Enter area name">
                    </div>
                    <div class="form-div">
                        <label for="">City/town</label>
                        <input type="text" name="city1" id="city1" placeholder="Enter city name">
                    </div>
                    <div class="form-div">
                        <label for="">Pincode</label>
                        <select type="text" name="pincode1" id="pincode1" required="required">
                            <option value="">Select a pincode</option>
                            <?php
                            foreach ($pincode as $pincodes) {
                            ?>
                                <option value="{{$pincodes->pincode}}"><?php echo $pincodes->pincode; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">State</label>
                        <select type="text" name="state1" id="state1" required="required">
                            <option value="">--Select State--</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
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
            </div>
            <!-- student2 -->
            <div class="student d-none  gap30" id="formId2">
                <h2 class="text-center">Student 2</h2>
                <!-- personal details -->
                <h2>Personal Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Student Name</label>
                        <input type="text" class="numdiv" name="studenname2" id="studenname2" placeholder="Enter student name">
                    </div>
                    <div class="form-div">
                        <label for="">Father's Name</label>
                        <input type="text" class="numdiv" name="father2"  id="father2" placeholder="Enter father's name">
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Mother's Name</label>
                        <input type="text" class="numdiv" name="mother2"  id="mother2" placeholder="Enter student name">
                    </div>
                    <div class="form-div">
                        <label for="">Gender</label>
                        <Select type="text" class="numdiv" name="gender2" require id="gender2">
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </Select>
                    </div>
                    <div class="form-div">
                        <label for="">DOB</label>
                        <input type="date" name="dob2" id="dob2"placeholder="Enter student name">
                    </div>
                </div>
                <!-- personal details -->
                <h2>Study Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">School Name</label>
                        <input class="numdiv" type="text" id="school2" name="school2"  placeholder="Enter school name">
                    </div>
                    <div class="form-div">
                        <label for="">Medium</label>
                        <select class="numdiv" id="medium2" name="medium2" >
                            <option value="hindi">Hindi</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Class</label>
                        <select type="text" class="numdiv" id="class2" name="class2" >
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
                        <select class="numdiv" id="subject2" name="subject2" >
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
                        <label for="">Area/Mohalla</label>
                        <input class="numdiv" type="text" name="area2" id="area2" placeholder="Enter area name">
                    </div>
                    <div class="form-div">
                        <label for="">City/town</label>
                        <input type="text" name="city2" id="city2" placeholder="Enter city name">
                    </div>
                    <div class="form-div">
                        <label for="">Pincode</label>
                        <select type="text" name="pincode2" id="pincode2" >
                            <option value="">Select a pincode</option>
                            <?php
                            foreach ($pincode as $pincodes) {
                            ?>
                                <option value="{{$pincodes->pincode}}"><?php echo $pincodes->pincode; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">State</label>
                        <select type="text" name="state2" id="state2" >
                            <option value="">--Select State--</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                        </select>
                    </div>

                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Permanent address</label>
                        <input class="numdiv" type="text" name="fulladd2" id="fulladd2" placeholder="Enter area name">
                    </div> 
                </div>
                <!-- Upload details -->
                <h2>File uploads</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Profile Image</label>
                        <input class="numdiv" type="file" name="image2" id="image2">
                    </div>
                    <div class="form-div">
                        <label for="">Aadhar Image</label>
                        <input type="file" class="numdiv" name="aadhar2" id="aadhar2">
                    </div>
                </div>
            </div>
            <!-- student3 -->
            <div class="student d-none gap30" id="formId3">
                <h2 class="text-center">Student 3</h2>
                <!-- personal details -->
                <h2>Personal Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Student Name</label>
                        <input type="text" class="numdiv" name="studenname3" id="studenname3" placeholder="Enter student name">
                    </div>
                    <div class="form-div">
                        <label for="">Father's Name</label>
                        <input type="text" class="numdiv" name="father3" id="father3" placeholder="Enter father's name">
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Mother's Name</label>
                        <input type="text" class="numdiv" name="mother3" id="mother3" placeholder="Enter student name">
                    </div>
                    <div class="form-div">
                        <label for="">Gender</label>
                        <Select type="text" class="numdiv" name="gender3"  id="gender3">
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </Select>
                    </div>
                    <div class="form-div">
                        <label for="">DOB</label>
                        <input type="date" name="dob3" id="dob3" placeholder="Enter student name">
                    </div>
                </div>
                <!-- personal details -->
                <h2>Study Details</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">School Name</label>
                        <input class="numdiv" type="text" id="school3" name="school3" placeholder="Enter school name">
                    </div>
                    <div class="form-div">
                        <label for="">Medium</label>
                        <select class="numdiv" id="medium3" name="medium3">
                            <option value="hindi">Hindi</option>
                            <option value="english">English</option>
                        </select>
                    </div>
                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Class</label>
                        <select type="text" class="numdiv" id="class3" name="class3" >
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
                        <select class="numdiv" id="subject3" name="subject3" >
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
                        <label for="">Area/Mohalla</label>
                        <input class="numdiv" type="text" name="area3" id="area3" placeholder="Enter area name">
                    </div>
                    <div class="form-div">
                        <label for="">City/town</label>
                        <input type="text" name="city3" id="city3" placeholder="Enter city name">
                    </div>
                    <div class="form-div">
                        <label for="">Pincode</label>
                        <select type="text" name="pincode3" id="pincode3" >
                            <option value="">Select a pincode</option>
                            <?php
                            foreach ($pincode as $pincodes) {
                            ?>
                                <option value="{{$pincodes->pincode}}"><?php echo $pincodes->pincode; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-div">
                        <label for="">State</label>
                        <select type="text" name="state3" id="state3" >
                            <option value="">--Select State--</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                        </select>
                    </div>

                </div>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Permanent address</label>
                        <input class="numdiv"type="text" name="fulladd3" id="fulladd3" placeholder="Enter area name">
                    </div> 
                </div>
                <!-- Upload details -->
                <h2>File uploads</h2>
                <div class="form-row flex align-center j-between gap30">
                    <div class="form-div">
                        <label for="">Profile Image</label>
                        <input class="numdiv" type="file" name="image3" id="image3">
                    </div>
                    <div class="form-div">
                        <label for="">Aadhar Image</label>
                        <input type="file" class="numdiv" name="aadhar3" id="aadhar3">
                    </div>
                </div>
            </div>
            <!-- terms and conditions -->
            <div class="checkbox-container">
                <input type="checkbox" id="myCheckbox" class="hidden-checkbox" >
                <label for="myCheckbox" class="checkbox-label"></label>
                <span class="checkbox-text">I agree with <a href="">terms and conditions</a></span>
            </div>
            <!-- register button -->
            <h2 class="text-center">299/- Registartion Fee</h2>
            <button type="submit" class="secondary-button" id="register">Register</button>
        </form>
    </div>
</div>


<script>
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
    $("#StudentSubmit").on('submit',function(data){
        $("#register").attr("disabled","disabled")
    })
</script>
@endsection