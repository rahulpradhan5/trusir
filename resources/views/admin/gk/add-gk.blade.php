@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Gk</h5>
            <div class="card">
                <div class="card-body">
                    <form action="" id="add-course-form" method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tittle</label>
                            <input type="text" class="form-control" name="tittle" id="tittle" aria-describedby="emailHelp" required="required">
                        </div>
                      
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category" aria-describedby="emailHelp" required="required">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Discription</label>
                            <textarea type="text" class="form-control" name="desc" id="desc" aria-describedby="emailHelp" placeholder="Enter your knowledge..." required="required"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" id="fileInput" name="fileInput" oninput="previewFile()" aria-describedby="emailHelp" >
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
            
                $.ajax({
                    url: '/admin/addedgk', // Replace with your Laravel route
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
            });
        });



</script>
@endsection