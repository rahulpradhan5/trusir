@extends('layout.layout')
@section('content')

<!-- profile -->
<div class="profile margin-t40">
    <div class="section">
        <div class="heading">
            Profile
        </div>
        <div class="profile-adjuster flex-colomn align-center j-center gap30">
            <div class="profile-container margin-t30">
                <div class="profile-heading flex align-center gap10">
                    <p>Personal Information</p>
                </div>
                <form action="studentPersonaledit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-card margin-t10 flex-colomn  gap20">
                        <p>Profile picture</p>
                        <div class="flex align-center gap30 flex-wrap">
                            <div class="profile-img">
                                <img src="{{$teachers[0]->image}}" alt="" id="previewimage">
                                <input type="file" class="d-none" id="profile" name="file" oninput="previewImage(event,'previewimage')">
                            </div>
                            <?php
                            if (Session()->get('role') == 'teacher') {
                            ?>
                                <button class="secondary-button" type="button" onclick="clicker('profile')">Upload</button>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="flex-colomn gap20">
                            <p>Name</p>
                            <input type="text" id="name" name="name" value="{{$teachers[0]->name}}" <?php
                                                                                                    if (!Session()->get('role') == 'teacher') {
                                                                                                        echo "readonly";
                                                                                                    }
                                                                                                    ?>>
                        </div>
                        <div class="flex-colomn gap20">
                            <p>Mobile</p>
                            <input type="tel" id="mobile" name="mobile" value="{{$teachers[0]->phone}}" readonly>
                        </div>
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Father's name</p>
                                <input type="text" id="f_name" name="f_name" value="{{$teachers[0]->father_name}}" <?php
                                                                                                                    if (!Session()->get('role') == 'teacher') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Mother's Name</p>
                                <input type="text" id="m_name" name="m_name" value="{{$teachers[0]->mother_name}}" <?php
                                                                                                                    if (!Session()->get('role') == 'teacher') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>
                            </div>
                        </div>
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Gender</p>
                                <select id="gender" name="gender" <?php if (Session()->get('role') !== 'teacher') {
                                                                        echo 'disabled';
                                                                    } ?>>
                                    <option value="male" <?php if ($teachers[0]->gender === 'male') {
                                                                echo 'selected';
                                                            } ?>>Male</option>
                                    <option value="female" <?php if ($teachers[0]->gender === 'female') {
                                                                echo 'selected';
                                                            } ?>>Female</option>
                                </select>

                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>DOB</p>
                                <input type="date" id="dob" name="dob" value="{{$teachers[0]->dob}}" <?php
                                                                                                        if (!Session()->get('role') == 'teacher') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                        </div>
                        <div class="form-row flex align-center j-between gap30">
                            <div class="flex-colomn gap20 width100">
                                <p>Qualification</p>
                                <input type="text" id="quali" name="quali" value="{{$teachers[0]->qulification}}" <?php
                                                                                                                    if (!Session()->get('role') == 'teacher') {
                                                                                                                        echo "readonly";
                                                                                                                    }
                                                                                                                    ?>>

                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Experience</p>
                                <input type="number" id="exp" name="exp" value="{{$teachers[0]->exp}}" <?php
                                                                                                        if (!Session()->get('role') == 'teacher') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                        </div>
                        <?php
                        if (Session()->get('role') == 'teacher') {
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
                                <input type="text" id="area" name="area" value="{{$teachers[0]->area}}" <?php
                                                                                                        if (!Session()->get('role') == 'teacher') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>City</p>
                                <input type="text" id="city" name="city" value="{{$teachers[0]->city}}" <?php
                                                                                                        if (!Session()->get('role') == 'teacher') {
                                                                                                            echo "readonly";
                                                                                                        }
                                                                                                        ?>>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>State</p>
                                <select type="text" id="state" name="state" value="{{$teachers[0]->state}}" <?php
                                                                                                            if (!Session()->get('role') == 'teacher') {
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
                                                                                if (!Session()->get('role') == 'teacher') {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>>
                                    <?php
                                    foreach ($pincodes as $pincode) {
                                    ?>
                                        <option value="{{$pincode->pincode}}" <?php if ($teachers[0]->pincode == $pincode->pincode) {
                                                                                    echo "selected";
                                                                                } ?>>{{$pincode->pincode}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="flex-colomn gap20 width100">
                                <p>Current Address</p>
                                <input type="text" id="current_address" name="current_address" value="{{$teachers[0]->current_full_address}}" <?php
                                                                                                                                                if (!Session()->get('role') == 'teacher') {
                                                                                                                                                    echo "readonly";
                                                                                                                                                }
                                                                                                                                                ?>>
                            </div>
                        </div>
                        <?php
                        if (Session()->get('role') == 'teacher') {
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
                                                                            if (!Session()->get('role') == 'teacher') {
                                                                                echo "disabled";
                                                                            }
                                                                            ?>>
                                    <?php
                                    foreach ($class as $classes) {
                                    ?>
                                        <option value="{{$classes->class_name}}" <?php if ($classes->class_name == $teachers[0]->preferd_class) {
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
                                                                                if (!Session()->get('role') == 'teacher') {
                                                                                    echo "disabled";
                                                                                }
                                                                                ?>>
                                    <option value="hindi" <?php if ($teachers[0]->medium == 'hindi') ?>>Hindi</option>
                                    <option value="english" <?php if ($teachers[0]->medium == 'english') ?>>English</option>
                                </select>
                            </div>

                        </div>
                        <?php
                        if (Session()->get('role') == 'teacher') {
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


<script>
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.addEventListener('load', () => {
            preview.src = reader.result;
        });

        reader.readAsDataURL(file);
    });


    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    $(document).ready(function() {
        $('#editform').submit(function(e) {
            e.preventDefault();
            var files = $('#fileInput')[0].files;

            if (files.length > 0) {
                const form = document.querySelector('#editform');
                var fd = new FormData(form);
                fd.append('file', files[0]);
                fd.append('_token', CSRF_TOKEN);
            } else {
                const form = document.querySelector('#editform');
                var fd = new FormData(form);
                fd.append('file', "<?php echo $teachers[0]->image; ?>");
                fd.append('_token', CSRF_TOKEN);
            }

            // AJAX request 
            $.ajax({
                url: "{{ route('editProfileteacher') }}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            // Update the button text or value with the percentage
                            $('#submit').attr("disabled", "disabled");
                            $('#submit').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    if (data == 1) {
                        $('#submit').removeAttr("disabled", "disabled");
                        $('#submit').html('Submit');
                        alert('Profile Updated Relode the page');
                    } else {
                        $('#submit').removeAttr("disabled", "disabled");
                        $('#submit').html('Submit');
                        alert('Failed Try Again');
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    });
</script>

@endsection