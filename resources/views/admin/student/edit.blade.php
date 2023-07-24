@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit student</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/editedstudent" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$student[0]->id}}">
                        <input type="hidden" name="oldimage" value="{{$student[0]->image}}">
                        <div style="display:flex;align-items:center;gap:20px;">
                            <img src="../{{$student[0]->image}}" alt="" style="width:100px;height:100px;border-radius:5px;border:1px solid blue;" id="preview">
                            <input type="file" style="display:none;" name="file" id="file" oninput="previewImage(event, 'preview')">
                            <button class="btn btn-primary btn-sm" onclick="clicker('file')" type="button">Upload</button>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" required="required" value="{{$student[0]->name}}">
                        </div>
                        <div style="display: flex;align-items:center;gap:20px;width:100%">
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Father's name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" aria-describedby="emailHelp" required="required" value="{{$student[0]->father_name}}">
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Mother's name</label>
                                <input type="text" class="form-control" name="m_name" id="m_name" aria-describedby="emailHelp" required="required" value="{{$student[0]->mother_name}}">
                            </div>
                        </div>
                        <div style="display: flex;align-items:center;gap:20px;width:100%">
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Gender</label>
                                <select type="text" class="form-control" name="gender" id="gender" aria-describedby="emailHelp" required="required">
                                    <option value="male" <?php if ($student[0]->gender == 'male') {
                                                                echo "selected";
                                                            } ?>>Male</option>
                                    <option value="female" <?php if ($student[0]->gender == 'female') {
                                                                echo "selected";
                                                            } ?>>Female</option>
                                </select>
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Dob</label>
                                <input type="date" class="form-control" name="dob" id="dob" aria-describedby="emailHelp" required="required" value="{{$student[0]->dob}}">
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Age</label>
                                <input type="number" class="form-control" name="age" id="age" aria-describedby="emailHelp" required="required" value="{{$student[0]->age}}">
                            </div>
                        </div>
                        <div style="display: flex;align-items:center;gap:20px;width:100%">
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Class</label>
                                <select type="text" class="form-control" name="class" id="class" aria-describedby="emailHelp" required="required">
                                    <?php
                                    foreach ($classes as $class) {
                                    ?>
                                        <option value="{{$class->class_name}}" <?php if ($class->class_name == $student[0]->class) {
                                                                                    echo "selected";
                                                                                } ?>>{{$class->class_name}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Medium</label>
                                <select type="text" class="form-control" name="medium" id="medium" aria-describedby="emailHelp" required="required">
                                    <option value="hindi" <?php if ($student[0]->medium == "hindi") {
                                                                echo "selected";
                                                            } ?>>Hindi</option>
                                    <option value="english" <?php if ($student[0]->medium == "english") {
                                                                echo "selected";
                                                            } ?>>English</option>
                                </select>
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">School name</label>
                                <input type="text" class="form-control" name="school" id="school" aria-describedby="emailHelp" required="required" value="{{$student[0]->school_name}}">
                            </div>
                        </div>
                        <div style="display: flex;align-items:center;gap:20px;width:100%">
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Area</label>
                                <input type="text" class="form-control" name="area" id="area" aria-describedby="emailHelp" required="required" value="{{$student[0]->area}}">
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">City</label>
                                <input type="city" class="form-control" name="city" id="city" aria-describedby="emailHelp" required="required" value="{{$student[0]->city}}">
                            </div>
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">State</label>
                                <select type="text" class="form-control" name="state" id="state" aria-describedby="emailHelp" required="required" value="{{$student[0]->state}}">
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
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Pincode</label>
                                <select type="text" class="form-control" name="pincode" id="pincode" aria-describedby="emailHelp" required="required" value="{{$student[0]->name}}">
                                    <?php
                                    foreach ($pincode as $pincodes) {
                                    ?>
                                        <option value="{{$pincodes->pincode}}" <?php if ($pincodes->pincode == $student[0]->pincode) {
                                                                                    echo "selected";
                                                                                } ?>>{{$pincodes->pincode}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Full address</label>
                            <input type="text" class="form-control" name="address" id="address" aria-describedby="emailHelp" required="required" value="{{$student[0]->current_full_address}}">
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection