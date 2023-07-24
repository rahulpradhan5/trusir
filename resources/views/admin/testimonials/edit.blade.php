@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit testimonials</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/testimonailedit" id="add-course-form" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$testimonial[0]->id}}">
                        <input type="hidden" name="oldimage" value="{{$testimonial[0]->img}}">
                        <div style="display:flex;align-items:center;gap:20px;">
                            <img src="../{{$testimonial[0]->img}}" alt="" style="width:100px;height:100px;border-radius:5px;border:1px solid blue;" id="preview">
                            <input type="file" style="display:none;" name="file" id="file" oninput="previewImage(event, 'preview')">
                            <button class="btn btn-primary btn-sm" onclick="clicker('file')" type="button">Upload</button>
                        </div>
                        <div class="mb-3" style="margin-top: 20px;">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" required="required" value="{{$testimonial[0]->name}}">
                        </div>
                        <div style="display: flex;align-items:center;gap:20px;width:100%">
                            <div class="mb-3" style="margin-top: 20px;width:100%">
                                <label for="exampleInputEmail1" class="form-label">Dicription</label>
                                <textarea type="text" class="form-control" name="desc" id="desc" aria-describedby="emailHelp" required="required">{{$testimonial[0]->description}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="upload-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection