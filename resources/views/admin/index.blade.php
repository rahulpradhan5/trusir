   @extends('admin.layout.layout')
   @section('content')
   <div class="container-fluid">
       <div class="row">
           <div style="display:flex;justify-content:space-between;align-items:center;gap:30px;flex-wrap:wrap;">
               <!-- total student -->
               <div class="card overflow-hidden">
                   <div class="card-body p-4">
                       <h5 class="card-title mb-9 fw-semibold">Total Students</h5>
                       <div class="row align-items-center">
                           <div class="col-8 text-center">
                               <h4 class="fw-semibold mb-3" style="color:#9c27b0">{{$students->count()}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- total teacher -->
               <div class="card overflow-hidden">
                   <div class="card-body p-4">
                       <h5 class="card-title mb-9 fw-semibold">Total Teachers</h5>
                       <div class="row">
                           <div class="col-8 text-center">
                               <h4 class="fw-semibold mb-3" style="color:#3f51b5;">{{$teacher->count()}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- student enquiry -->

               <div class="card overflow-hidden">
                   <div class="card-body p-4">
                       <h5 class="card-title mb-9 fw-semibold">Student Enquary</h5>
                       <div class="row align-items-center">
                           <div class="col-8 text-center">
                               <h4 class="fw-semibold mb-3" style="color: #2196F3;">{{$student_enq->count()}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- teacher enquiry -->
               <div class="card overflow-hidden">
                   <div class="card-body p-4">
                       <h5 class="card-title mb-9 fw-semibold">Teacher Enquary</h5>
                       <div class="row align-items-center">
                           <div class="col-8 text-center">
                               <h4 class="fw-semibold mb-3" style="color: #FF9800;">{{$teacher_enq->count()}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
                <!-- teacher enquiry -->
               <div class="card overflow-hidden">
                   <div class="card-body p-4">
                       <h5 class="card-title mb-9 fw-semibold">Total Income</h5>
                       <div class="row align-items-center">
                           <div class="col-8 text-center">
                               <h4 class="fw-semibold mb-3" style="color: green;white-space:nowrap;">₹{{$payment}}</h4>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="row">
           <div class="card w-100">
               <div class="card-body p-4">
                   <h5 class="card-title fw-semibold mb-4">New Students</h5>
                   <div class="table-responsive">
                       <table class="table text-nowrap mb-0 align-middle">
                           <thead class="text-dark fs-4">
                               <tr>
                                   <th class="border-bottom-0">
                                       <h6 class="fw-semibold mb-0">S.no</h6>
                                   </th>
                                   <th class="border-bottom-0">
                                       <h6 class="fw-semibold mb-0">Name</h6>
                                   </th>
                                   <th class="border-bottom-0">
                                       <h6 class="fw-semibold mb-0">Phone</h6>
                                   </th>
                                   <th class="border-bottom-0">
                                       <h6 class="fw-semibold mb-0">Class</h6>
                                   </th>
                                   <th class="border-bottom-0">
                                       <h6 class="fw-semibold mb-0">Action</h6>
                                   </th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php
                                if ($students->count() >= 10) {
                                    $count = 10;
                                } else {
                                    $count = $students->count() - 1;
                                }
                                if ($count < 0) {
                                ?>
                                   <tr >
                                       <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                           <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                       </td>
                                   </tr>
                                   <?php
                                } else {
                                    for ($i = 0; $i <= $count; $i++) {
                                    ?>
                                       <tr id="studnet{{$students[$i]->id}}">
                                           <td class="border-bottom-0">
                                               <h6 class="fw-semibold mb-0">{{$i + 1}}</h6>
                                           </td>
                                           <td class="border-bottom-0">
                                               <h6 class="fw-semibold mb-1">{{$students[$i]->name}}</h6>
                                           </td>
                                           <td class="border-bottom-0">
                                               <p class="mb-0 fw-normal">{{$students[$i]->phone}}</p>
                                           </td>
                                           <td class="border-bottom-0">
                                               <p class="mb-0 fw-normal">Class {{$students[$i]->class}}</p>
                                           </td>
                                           <td class="border-bottom-0 d-flex align-items-center gap-2">
                                               <div class="d-flex align-items-center gap-2">
                                                   <a href="/admin/view-student?id={{$students[$i]->id}}"><button class="btn btn-primary btn-sm">View</button></a>
                                               </div>
                                               <div class="d-flex align-items-center gap-2">
                                                   <a href="admin/edit-student?id={{$students[$i]->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                                               </div>
                                               <div class="d-flex align-items-center gap-2">
                                                   <button class="btn btn-danger btn-sm" id="delete{{$students[$i]->id}}" onclick="deleteuser('{{$students[$i]->id}}','studnet{{$students[$i]->id}}')">Delete</button>
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
    function deleteuser(id){
        $.ajax({
            url:"/admin/deletestudent",
            data:{
                id:id
            },
            type:'get',
            success:function(data){
                if(data == "success"){
                    alert("User deleted");
                    $("#studnet"+id).remove();
                }else{
                    alert(data);
                }
            }
        })
    }
   </script>
   @endsection