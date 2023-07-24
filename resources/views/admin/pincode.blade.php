@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex" style="align-items: center;justify-content:space-between;">
                    <h5 class="card-title fw-semibold mb-4">Pincodes</h5>
                   <a href="/admin/add-pincode"> <button class="btn btn-primary">Add+</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.no</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Pincode</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">City</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">State</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($pincode->count() <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="../assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                foreach ($pincode as $pin) {
                                ?>
                                    <tr id="pincode{{$pin->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i}}</h6>
                                        </td>
                                        <?php
                                        $i = $i + 1;
                                        ?>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$pin->pincode}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$pin->city}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$pin->state}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$pin->status}}</p>
                                        </td>
                                        
                                        <td class="border-bottom-0 d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="edit-pincode?id={{$pin->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-danger btn-sm" id="delete{{$pin->id}}" onclick="deletepin('{{$pin->id}}','pincode{{$pin->id}}')">Delete</button>
                                            </div>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

function deletepin(id){
    
    $.ajax({
        url:'/admin/deletepin',
        data:{
            id:id
        },
        type:'get',
        success:function(data){
           
            if (data == "success") {
                    $("#course" + id).remove();
                    $("#alert").html("Pincode deletd successfully");
                    $("#alert").addClass("ale-succ");
                    $("#pincode"+id).remove();
                    setTimeout(function() {
                        $("#alert").removeClass("ale-succ");
                    }, 3000);
                }else{
                    $("#alert").html("Failed");
                    $("#alert").addClass("ale-den");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-den");
                    }, 3000);
                }
        }
    })
}
</script>
@endsection