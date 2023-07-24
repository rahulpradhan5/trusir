<?php

if ($teachers->count() <= 0) {
?>
    <tr>
        <td class="border-bottom-0" style="display: flex;gap:5px;align-items:center;">
            <img src="assets/images/products/sad.svg" alt="" style="height:20px;width:20px;"> No data found
        </td>
    </tr>
    <?php
} else {
    $i = 1;
    foreach ($teachers as $teacher) {
    ?>
        <tr id="teacher{{$teacher->id}}">
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{$i}}</h6>
                <?php $i = $i + 1; ?>
            </td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1">{{$teacher->name}}</h6>
            </td>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$teacher->phone}}</p>
            </td>
            <td class="border-bottom-0">
                <p class="mb-0 fw-normal">Class {{$teacher->preferd_class}}</p>
            </td>
            <td class="border-bottom-0">
                <div class="slots" style="max-width: 150px;overflow:scroll;display:flex; gap:10px;">
                    <?php
                    if ($teacher->slot->count() == 0) {
                    ?>
                        <div class="adjuster" style="display: flex;flex-direction:column;align-items:center;justify-content:center;background-color:#009aff40;padding:3px 7px;border-radius:5px;">
                            <p style="margin-bottom: 0 !important;">N/A</p>
                        </div>
                        <?php
                    } else {
                        foreach ($teacher->slot as $slot) {
                        ?>
                            <div class="adjuster" style="display: flex;flex-direction:column;align-items:center;justify-content:center;background-color:#009aff40;padding:3px 7px;border-radius:5px;">
                                <?php
                                if ($slot->status == "booked") {
                                ?>
                                    <span style="width: 10px;height:10px;border-radius:50%;background-color:red;"></span>
                                <?php
                                } else {
                                ?>
                                    <span style="width: 10px;height:10px;border-radius:50%;background-color:green;"></span>
                                <?php

                                }
                                ?>
                                <p style="margin-bottom: 0 !important;">{{$slot->timing}}</p>
                            </div>
                        <?php
                        }
                        ?>

                    <?php
                    }
                    ?>
                </div>
            </td>
            <td class="border-bottom-0 d-flex align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="/admin/view-teacher?id={{$teacher->id}}"><button class="btn btn-primary btn-sm">View</button></a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="admin/edit-student?id={{$teacher->id}}"><button class="btn btn-success btn-sm">Edit</button></a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-danger btn-sm" id="delete{{$teacher->id}}" onclick="deleteteacher('{{$teacher->id}}','studnet{{$teacher->id}}')">Delete</button>
                </div>
            </td>

        </tr>
<?php
    }
}
?>