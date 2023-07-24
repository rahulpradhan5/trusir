@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Give courses</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/assignteacher" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$_GET['id']}}">
                        <input type="hidden" name="course" value="{{$_GET['course_id']}}">
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Teacher</label>
                            <select type="text" class="form-control" name="teacher" id="teacher" aria-describedby="emailHelp" required="required" oninput="loadslot()">
                                <option value="">Select a teacher</option>
                                <?php
                                if ($teachers->count() > 0) {
                                    foreach ($teachers as $course) {
                                ?>

                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">No teacher to assign</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Slot</label>
                            <select type="text" class="form-control" name="slot" id="slot" aria-describedby="emailHelp" required="required">
                                <option value="">Select slot</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadslot() {
        var id = $("#teacher").val();
        $.ajax({
            url: "loadslot",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                var da = '<option>Select a slot</option>';
                for (var i = 0; i <= data.length - 1; i++) {
                    da = da + `<option value="` + data[i].id + `">` + data[i].timing + `</option>`;
                }
                $("#slot").html(da);
            }
        })
    }
</script>
@endsection