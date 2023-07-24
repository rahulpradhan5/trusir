@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Students</h5>
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
                                    <h6 class="fw-semibold mb-0">City</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Pincode</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                          
                            if ($enq->count() <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $i = 0;
                                foreach ($enq as $student) {
                                ?>
                                    <tr id="studnet{{$student->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i + 1}}</h6>
                                        </td>
                                        <?php
                                        $i = $i + 1;
                                        ?>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$student->student_name}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$student->mobile}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">Class {{$student->class}}</p>
                                        </td>
                                        
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$student->city}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$student->pincode}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$student->dt}}</p>
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
@endsection