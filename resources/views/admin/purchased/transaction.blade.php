@extends('admin.layout.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Course purchased</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">S.no</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Transaction id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Phone</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Amount</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Date</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $count = $transaction->count() - 1;

                            if ($count <= 0) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
                                        <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $i = 1;
                                foreach ($transaction as $purchasedd) {
                                ?>
                                    <tr id="studnet{{$purchasedd->id}}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{$i }}</h6>
                                            <?php
                                            $i = $i + 1;
                                            ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{$purchasedd->transaction_id}}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$purchasedd->mobile}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">₹ {{$purchasedd->amount}}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <?php
                                            if ($purchasedd->status == 'captured') {
                                            ?>
                                                <p class="mb-0 fw-normal" style="color:green;">{{$purchasedd->status}}</p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mb-0 fw-normal" style="color:red;">{{$purchasedd->status}}</p>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="border-bottom-0">
                                            <?php
                                            if ($purchasedd->type == 'Add course') {
                                            ?>
                                                <p class="mb-0 fw-normal" style="padding: 5px 7px;border-radius:5px;background-color:#bb00ff;width:fit-content;color:white;">{{$purchasedd->type}}</p>
                                            <?php
                                            } else if ($purchasedd->type == 'student registration') {
                                            ?>
                                                <p class="mb-0 fw-normal" style="padding: 5px 7px;border-radius:5px;background-color:green;width:fit-content;color:white;">{{$purchasedd->type}}</p>
                                            <?php
                                            } else if ($purchasedd->type == 'teacher registration') {
                                            ?>
                                                <p class="mb-0 fw-normal" style="padding: 5px 7px;border-radius:5px;background-color:blue;width:fit-content;color:white;">{{$purchasedd->type}}</p>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="mb-0 fw-normal" style="padding: 5px 7px;border-radius:5px;background-color:pink;width:fit-content;color:white;">{{$purchasedd->type}}</p>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{$purchasedd->dt}}</p>
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