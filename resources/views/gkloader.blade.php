<?php
if (isset($me)) {
    foreach ($gk as $gks) {
?>
        <!-- post card -->
        <div class="post-card flex gap10 " id="gkd{{$gks->id}}">
            <!-- post-image -->
            <?php
            if ($gks->image != "") {
            ?>
                <div class="post-img">
                    <img src="{{$gks->image}}" alt="">
                </div>

            <?php
            }
            ?>
            <!-- cancel -->
            <?php
            if ($gks->teacher_id == Session()->get('user_id') && Session()->get('role') == 'teacher') {
            ?>
                <div class="cancel" onclick="deleteCate('{{ $gks->id}}')">
                    <img src="images/cancel-red.svg" alt="">
                </div>
            <?php
            }
            ?>
            <!-- post-content -->
            <div class="content flex-colomn gap10">
                <h3>{{$gks->tittle}}</h3>
                <div class="flex-colomn">
                    <div class="flex gap10 align-center">
                        <?php
                        if (Session()->get('role') == 'student' && Session()->get('user_id') == $gks->student_id) {
                        ?>
                            <span class="tag">For you</span>
                        <?php
                        }
                        ?>
                        <span class="tag">{{ $gks->category}}</span>
                    </div>
                    <span>Posted at: {{$gks->dt}}</span>
                </div>
                <p class="p-primary expand" id="desc{{$gks->id}}">{{$gks->disc}}</p>
                <span class="read-more width100" id="gk{{$gks->id}}" onclick="readmore('gk{{$gks->id}}','desc{{$gks->id}}')">Read more</span>
            </div>
        </div>
    <?php
    }
} else if (isset($loadmore)) {
    foreach ($gk as $gks) {
    ?>
        <!-- post card -->
        <div class="post-card flex gap10 " id="gkd{{$gks->id}}">
            <!-- post-image -->
            <?php
            if ($gks->image != "") {
            ?>
                <div class="post-img">
                    <img src="{{$gks->image}}" alt="">
                </div>

            <?php
            }
            ?>
            <!-- cancel -->
            <?php
            if ($gks->teacher_id == Session()->get('user_id') && Session()->get('role') == 'teacher') {
            ?>
                <div class="cancel" onclick="deleteCate('{{ $gks->id}}')">
                    <img src="images/cancel-red.svg" alt="">
                </div>
            <?php
            }
            ?>
            <!-- post-content -->
            <div class="content flex-colomn gap10">
                <h3>{{$gks->tittle}}</h3>
                <div class="flex-colomn">
                    <div class="flex gap10 align-center">
                        <?php
                        if (Session()->get('role') == 'student' && Session()->get('user_id') == $gks->student_id) {
                        ?>
                            <span class="tag">For you</span>
                        <?php
                        }
                        ?>
                        <span class="tag">{{ $gks->category}}</span>
                    </div>
                    <span>Posted at: {{$gks->dt}}</span>
                </div>
                <p class="p-primary expand" id="desc{{$gks->id}}">{{$gks->disc}}</p>
                <span class="read-more width100" id="gk{{$gks->id}}" onclick="readmore('gk{{$gks->id}}','desc{{$gks->id}}')">Read more</span>
            </div>
        </div>
    <?php
    } ?>
    <?php
    if ($gk->count() == 0) {
        $id = 0;
    } else if ($gk->count() - 1 < 0) {
        $id = $gk[$gk->count()]->id;
    } else {
        $id =  $gk[$gk->count() - 1]->id;
    }

    ?>
    <input type="hidden" id="contentId" value="{{$id}}">
    <?php
} else {
    foreach ($gk as $gks) {
    ?>
        <!-- post card -->
        <div class="post-card flex gap10 " id="gkd{{$gks->id}}">
            <!-- post-image -->
            <?php
            if ($gks->image != "") {
            ?>
                <div class="post-img">
                    <img src="{{$gks->image}}" alt="">
                </div>

            <?php
            }
            ?>
            <!-- cancel -->
            <?php
            if ($gks->teacher_id == Session()->get('user_id') && Session()->get('role') == 'teacher') {
            ?>
                <div class="cancel" onclick="deleteCate('{{ $gks->id}}')">
                    <img src="images/cancel-red.svg" alt="">
                </div>
            <?php
            }
            ?>
            <!-- post-content -->
            <div class="content flex-colomn gap10">
                <h3>{{$gks->tittle}}</h3>
                <div class="flex-colomn">
                    <div class="flex gap10 align-center">
                        <?php
                        if (Session()->get('role') == 'student' && Session()->get('user_id') == $gks->student_id) {
                        ?>
                            <span class="tag">For you</span>
                        <?php
                        }
                        ?>
                        <span class="tag">{{ $gks->category}}</span>
                    </div>
                    <span>Posted at: {{$gks->dt}}</span>
                </div>
                <p class="p-primary expand" id="desc{{$gks->id}}">{{$gks->disc}}</p>
                <span class="read-more width100" id="gk{{$gks->id}}" onclick="readmore('gk{{$gks->id}}','desc{{$gks->id}}')">Read more</span>
            </div>
        </div>
<?php
    }
}
?>