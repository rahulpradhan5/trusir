@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Give courses</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/givecourse" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$_GET['id']}}">
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Course</label>
                            <select type="text" class="form-control" name="course" id="course" aria-describedby="emailHelp" required="required">
                            <option value="">Select a course</option>
                               <?php
                                if($courses->count() > 0){
                                foreach ($courses as $course) {
                                ?>
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                <?php
                                }
                            }else{
                                ?>
                                 <option value="">No course to purchased</option>
                                <?php
                            }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Type</label>
                            <select type="text" class="form-control" name="type" id="type" aria-describedby="emailHelp" required="required">
                                <option value="">Select course type</option>
                                <option value="purchased">Purchased</option>
                                <option value="demo">demo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection