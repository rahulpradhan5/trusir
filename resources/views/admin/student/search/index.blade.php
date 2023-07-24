<?php

$count = $students->count();

if ($count <= 0) {
?>
    <tr>
        <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
            <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
        </td>
    </tr>
    <?php
} else {
    for ($i = 0; $i <= $count - 1; $i++) {
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
                    <a href="/admin/edit-student?id={{$students[$i]->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-danger btn-sm" id="delete{{$students[$i]->id}}" onclick="delete('{{$students[$i]->id}}','studnet{{$students[$i]->id}}')">Delete</button>
                </div>
            </td>

        </tr>
<?php
    }
}
?>