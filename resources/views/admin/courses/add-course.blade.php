@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Course</h5>
            <div class="card">
                <div class="card-body">
                    <form action="" id="add-course-form" method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Course Name</label>
                            <input type="text" class="form-control" name="course_name" id="course_name" aria-describedby="emailHelp" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Subject</label>
                            <div class="d-flex" style="gap: 10px;">
                                <select class="form-control" name="subject" id="subject" required="required">
                                    <option value="">Select a Subject</option>
                                    <?php
                                    foreach ($subjects as $subject) {
                                    ?>
                                        <option value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button type="button" class="btn btn-primary" onclick="modalShow('exampleModal')">Add+</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Class</label>
                            <div class="d-flex" style="gap: 10px;">
                                <select class="form-control" name="class" id="class" required="required">
                                    <option value="">Select a class</option>
                                    <?php
                                    foreach ($class as $classs) {
                                    ?>
                                        <option value="{{$classs->class_name}}">{{$classs->class_name}}</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <button type="button" class="btn btn-primary" onclick="modalShow('classModal')">Add+</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Medium</label>
                            <select class="form-control" name="medium" id="medium" required="required">
                                <option value="">Select a Medium</option>
                                <option value="hindi">Hindi</option>
                                <option value="english">English</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" aria-describedby="emailHelp" placeholder="$200" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" id="fileInput" name="fileInput" oninput="previewFile()" aria-describedby="emailHelp" required="required">
                        </div>
                        <div class="mb-3">
                            <img src="../assets/images/products/s4.jpg" alt="" id="preview" style="height: 100px;width:100px;border-radius:5px;display:none;">
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- subject Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modalclose('exampleModal')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="subject_name" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="modalclose('exampleModal')">Close</button>
                <button type="button" class="btn btn-primary" onclick="addSubject() ">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- class Modal -->
<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modalclose('classModal')"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Class</label>

                    <input type="text" class="form-control" id="class_name" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="modalclose('classModal')">Close</button>
                <button type="button" class="btn btn-primary" onclick="addClass()">Save changes</button>
            </div>
        </div>
    </div>
</div>




<script>
    const fileInput = document.getElementById("fileInput");
    fileInput.addEventListener("change", previewFile);

    function previewFile() {
        $("#preview").css("display", "flex")
        const preview = document.getElementById("preview");
        const file = document.querySelector('#fileInput').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function() {
            // Convert the file to a data URL
            preview.src = reader.result;
        }, false);

        if (file) {
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    }



    $(document).ready(function() {
        $('#add-course-form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            if ($("#subject").val() == "") {
                $("#alert").html("Plese choose a subject");
                $("#alert").addClass("ale-dan");
                setTimeout(function() {
                    $("#alert").removeClass("ale-dan");
                }, 3000);
            } else if ($("#class").val() == "") {
                $("#alert").html("Plese choose a class");
                $("#alert").addClass("ale-dan");
                setTimeout(function() {
                    $("#alert").removeClass("ale-dan");
                }, 3000);
            } else if ($("#medium").val() == "") {
                $("#alert").html("Plese choose a medium");
                $("#alert").addClass("ale-dan");
                setTimeout(function() {
                    $("#alert").removeClass("ale-dan");
                }, 3000);
            } else {
                $.ajax({
                    url: '/admin/addedCourse', // Replace with your Laravel route
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#upload-btn').html('Uploading (' + percent + '%)');
                                $('#upload-btn').attr("disabled", "disabled");
                            }
                        });
                        return xhr;
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == "success") {
                            $('#upload-btn').removeAttr("disabled", "disabled");
                            $('#upload-btn').html('Upload');
                            $("#add-course-form")[0].reset();
                            $("#preview").css("display", "none");
                            $("#alert").html("Course added successfully");
                            $("#alert").addClass("ale-succ");
                            setTimeout(function() {
                                $("#alert").removeClass("ale-succ");
                            }, 3000);

                        } else {
                            $('#upload-btn').removeAttr("disabled", "disabled");
                            $('#upload-btn').html('Upload');
                            $("#alert").html("Course added Failed");
                            $("#alert").addClass("ale-dan");
                            setTimeout(function() {
                                $("#alert").removeClass("ale-dan");
                            }, 3000);
                        }
                    },
                    error: function(xhr) {
                        $('#upload-btn').html('Upload');
                        alert('Error uploading file: ' + xhr.responseText);
                        $('#upload-btn').removeAttr("disabled", "disabled");
                        $('#upload-btn').html('Upload');
                    }
                });
            }
        });
    });

    function addSubject() {
        $.ajax({
            url: "/admin/add-subject",
            data: {
                subject: $("#subject_name").val(),
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    modalclose("exampleModal");
                    $("#alert").html("Subject added");
                    $("#alert").addClass("ale-succ");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-succ");
                    }, 3000);
                    document.getElementById("subject_name").value = "";
                    loadsubject();
                } else {
                    $("#alert").html("Subject added Failed");
                    $("#alert").addClass("ale-dan");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-dan");
                    }, 3000);
                }
            }
        })
    }

    function addClass() {
        $.ajax({
            url: "/admin/add-class",
            data: {
                subject: $("#class_name").val(),
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    modalclose("classModal");
                    $("#alert").html("Class added");
                    $("#alert").addClass("ale-succ");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-succ");
                    }, 3000);
                    document.getElementById("class_name").value = "";
                    loadclass();
                } else {
                    $("#alert").html("Class added Failed");
                    $("#alert").addClass("ale-dan");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-dan");
                    }, 3000);
                }
            }
        })
    }

    function loadsubject() {
        $.ajax({
            url: "/admin/load-subject",
            type: 'get',
            success: function(data) {

                var dummy = `<option value="">Select a Subject</option>`;
                for (var i = 0; i <= data.length - 1; i++) {
                    dummy += `<option value="${data[i].subject_name}">${data[i].subject_name}</option>`
                }
                $("#subject").html(dummy);
            }
        })
    }

    function loadclass() {
        $.ajax({
            url: "/admin/load-class",
            type: 'get',
            success: function(data) {

                var dummy = `<option value="">Select a Class</option>`;
                for (var i = 0; i <= data.length - 1; i++) {
                    dummy += `<option value="${data[i].class_name}">${data[i].class_name}</option>`
                }
                $("#class").html(dummy);
            }
        })
    }
</script>
@endsection