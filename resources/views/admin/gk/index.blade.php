@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="d-flex" style="justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h3>General Knowladge</h3>
        <a href="/admin/add-gk"><button class="btn btn-primary">Add+</button></a>
    </div>
    <div class="row">
        <div style="display:flex;justify-content:flex-start;align-items:center;gap:30px;flex-wrap:wrap;flex-direction:column;">
            <?php foreach ($gk as $courses) {
            ?>
                <div class="card" style="width: 100%;display:flex;flex-direction:row;" id="course{{$courses->id}}">
                    <?php
                    if ($courses->image != "") {
                    ?>
                        <img src="../{{$courses->image}}" class="card-img-top" alt="..." style="height: 250px;width:30%;">
                    <?php
                    }
                    ?>
                    <div class="card-body">
                        <div class="d-flex" style="justify-content:space-between;align-items:center;">
                            <h5 class="card-title">{{$courses->tittle}}</h5>
                        </div>
                        <p class="card-text">Category:{{$courses->category}}</p>
                        <p class="card-text">Disc:{{$courses->disc}}</p>
                        <div class="d-flex" style="justify-content: flex-end;align-items:center;gap:10px;">
                            <!-- <a href="/admin/edit-course?id={{$courses->id}}" class="btn btn-primary">Edit</a> -->
                            <a onclick="deletecourse('{{$courses->id}}')" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    function deletecourse(id) {
        $.ajax({
            url: "/admin/deletegk",
            data: {
                id: id
            },
            type: 'get',
            success: function(data) {
                if (data == "success") {
                    $("#course" + id).remove();
                    $("#alert").html("Course deletd successfully");
                    $("#alert").addClass("ale-succ");
                    setTimeout(function() {
                        $("#alert").removeClass("ale-succ");
                    }, 3000);
                } else {
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