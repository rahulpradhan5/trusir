@extends('layout.layout')
@section('content')

<!-- profile -->
<div class="profile margin-t40">
    <div class="section">
        <div class="heading">
            Profile
        </div>
        <div class="profile-adjuster flex-colomn align-center j-center gap30 margin-t30">
            <div class="flex align-center gap30 width80 j-center">
                <div class="flex align-center gap30  scroll-x">
                    <a href="Attendance?id={{$profile[0]->id}}"><button class="third-button">Attandance</button></a>
                    <a href="Testseries?id={{$profile[0]->id}}"><button class="third-button">Test Series</button></a>
                    <a href="Student_doubt?id={{$profile[0]->id}}"><button class="third-button">Student Doubt</button></a>
                    <a href="progress?id={{$profile[0]->id}}"><button class="third-button">Progress Report</button></a>
                    <a href="General_Knowledge?id={{$profile[0]->id}}"><button class="third-button">General Knowledge</button></a>
                    <a href="Notice?id={{$profile[0]->id}}"><button class="third-button">Notice</button></a>
                </div>
            </div>
            <div class="profile-container margin-t20">
                <div class="profile-heading flex align-center gap10">
                    <p>Personal Information</p>
                </div>
                <form action="studentPersonaledit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-card margin-t10 flex-colomn  gap20">
                        <p>Profile picture</p>
                        <div class="flex align-center gap30 flex-wrap">
                            <div class="profile-img">
                                <img src="{{$profile[0]->image}}" alt="" id="previewimage">
                                <input type="file" class="d-none" id="profile" name="file" oninput="previewImage(event,'previewimage')">
                            </div>
                            <?php
                            if (Session()->get('role') == 'student') {
                            ?>
                                <button class="secondary-button" type="button" onclick="clicker('profile')">Upload</button>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="flex-colomn gap20">
                            <p>Name</p>
                            <input type="text" id="name" name="name" value="{{$profile[0]->name}}" <?php
                                                                                                    if (!Session()->get('role') == 'student') {
                                                                                                        echo "readonly";
                                                                                                    }
                                                                                                    ?>>
                        </div>
                        <div class="flex-colomn gap20">
                            <p>Mobile</p>
                            <input type="tel" id="mobile" name="mobile" value="{{$profile[0]->phone}}" readonly>
                        </div>
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Father's name</p>
                                <input type="text" id="f_name" name="f_name" value="{{$profile[0]->father_name}}" <?php
                                                                                                                    if (!Session()->get('role') == 'student') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Mother's Name</p>
                                <input type="text" id="m_name" name="m_name" value="{{$profile[0]->mother_name}}" <?php
                                                                                                                    if (!Session()->get('role') == 'student') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>
                            </div>
                        </div>
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Gender</p>
                                <select id="gender" name="gender" <?php if (Session()->get('role') !== 'student') {
                                                                        echo 'disabled';
                                                                    } ?>>
                                    <option value="male" <?php if ($profile[0]->gender === 'male') {
                                                                echo 'selected';
                                                            } ?>>Male</option>
                                    <option value="female" <?php if ($profile[0]->gender === 'female') {
                                                                echo 'selected';
                                                            } ?>>Female</option>
                                </select>

                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>DOB</p>
                                <input type="date" id="dob" name="dob" value="{{$profile[0]->dob}}" <?php
                                                                                                    if (!Session()->get('role') == 'student') {
                                                                                                        echo "readonly";
                                                                                                    }
                                                                                                    ?>>
                            </div>
                        </div>
                        <?php
                        if (Session()->get('role') == 'student') {
                        ?>
                            <div class="flex">
                                <button class="secondary-button">Update</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>

                <!-- Address imformation -->
                <div class="profile-heading flex align-center gap10 margin-t40">
                    <p>Address Information</p>
                </div>
                <form action="studentAddressEdit" method="post" class="margin-t40">
                    @csrf
                    <div class="profile-card margin-t10 flex-colomn  gap20">
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Area</p>
                                <input type="text" id="area" name="area" value="{{$profile[0]->area}}" <?php
                                                                                                        if (!Session()->get('role') == 'student') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>City</p>
                                <input type="text" id="city" name="city" value="{{$profile[0]->city}}" <?php
                                                                                                        if (!Session()->get('role') == 'student') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>State</p>
                                <select type="text" id="state" name="state" value="{{$profile[0]->state}}" <?php
                                                                                                            if (!Session()->get('role') == 'student') {
                                                                                                                echo "disabled";
                                                                                                            }
                                                                                                            ?>>
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
                            <div class="flex-colomn gap20 width100">
                                <p>Pincode</p>
                                <select type="text" id="pincode" name="pincode" <?php
                                                                                if (!Session()->get('role') == 'student') {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>>
                                    <?php
                                    foreach ($pincodes as $pincode) {
                                    ?>
                                        <option value="{{$pincode->pincode}}" <?php if ($profile[0]->pincode == $pincode->pincode) {
                                                                                    echo "selected";
                                                                                } ?>>{{$pincode->pincode}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Current Address</p>
                                <input type="text" id="current_address" name="current_address" value="{{$profile[0]->current_full_address}}" <?php
                                                                                                                                                if (!Session()->get('role') == 'student') {
                                                                                                                                                    echo "readonly";
                                                                                                                                                }
                                                                                                                                                ?>>
                            </div>
                        </div>
                        <?php
                        if (Session()->get('role') == 'student') {
                        ?>
                            <div class="flex">
                                <button class="secondary-button">Update</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>

                <!-- Address imformation -->
                <div class="profile-heading flex align-center gap10 margin-t40">
                    <p>Study Information</p>
                </div>
                <form action="studentstudyEdit" method="post" class="margin-t40">
                    @csrf
                    <div class="profile-card margin-t10 flex-colomn  gap20">
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Class</p>
                                <select type="text" id="class" name="class" <?php
                                                                            if (!Session()->get('role') == 'student') {
                                                                                echo "disabled";
                                                                            }
                                                                            ?>>
                                    <?php
                                    foreach ($class as $classes) {
                                    ?>
                                        <option value="{{$classes->class_name}}" <?php if ($classes->class_name == $profile[0]->class) {
                                                                                        echo "selected";
                                                                                    } ?>>{{$classes->class_name}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Medium</p>
                                <select type="text" id="medium" name="medium" <?php
                                                                                if (!Session()->get('role') == 'student') {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>>
                                    <option value="hindi" <?php if ($profile[0]->medium == 'hindi') ?>>Hindi</option>
                                    <option value="english" <?php if ($profile[0]->medium == 'english') ?>>English</option>
                                </select>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>School</p>
                                <input type="text" name="school" id="school" value="{{$profile[0]->school_name}}" <?php
                                                                                                                    if (!Session()->get('role') == 'student') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>
                            </div>
                        </div>
                        <?php
                        if (Session()->get('role') == 'student') {
                        ?>
                            <div class="flex">
                                <button class="secondary-button">Update</button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection