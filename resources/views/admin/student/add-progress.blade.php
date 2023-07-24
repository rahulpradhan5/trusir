@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Progress report</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/progressadd" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$_GET['id']}}">
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Course</label>
                            <select type="text" class="form-control" name="course" id="course" aria-describedby="emailHelp" required="required">
                                <?php
                                if($courses->count() > 0){
                                foreach ($courses as $course) {
                                ?>
                                <option value="">Select a course</option>
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                <?php
                                }
                            }else{
                                ?>
                                 <option value="">No course </option>
                                <?php
                            }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Progress report</label>
                            <input type="file" class="form-control" name="file" id="file" aria-describedby="emailHelp" required="required">
                              
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Obtain marks</label>
                            <input type="number" class="form-control" name="obtainmark" id="obtainmark" aria-describedby="emailHelp" required="required" placeholder="Ex 20">
                              
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Total marks</label>
                            <input type="number" class="form-control" name="totalmarks" id="totalmarks" aria-describedby="emailHelp" required="required" placeholder="Ex 100">
                              
                        </div>
                       
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection