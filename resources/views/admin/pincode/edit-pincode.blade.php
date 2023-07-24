@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Pincode</h5>
            <div class="card">
                <div class="card-body">
                    <form action="/admin/editededPincode" id="add-course-form" method="get">
                    <input type="hidden" name="id" value="{{$pincode[0]->id}}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" aria-describedby="emailHelp" required="required" value="{{$pincode[0]->pincode}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="active" <?php if($pincode[0]->status == "active"){echo "selected";}?>>Active</option>
                                <option value="deactive" <?php if($pincode[0]->status == "deactive"){echo "selected";}?>>Deactive</option>
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