@extends('layout.layout')
@section('content')
<div class="select-profile margin-t30">
    <div class="section flex-colomn align-center gap30">
        <h1>Select a Profile</h1>
        <div class="flex align-center j-center gap30">
            <?php
            foreach ($profiles as $teacher) {
                if (Session()->get("role") == "student") {
            ?>
                    <a href="setlogin?id=<?php echo $teacher->id; ?>&type=student" style="text-decoration: none;">
                        <div class="card">
                            <img src="<?php echo asset($teacher->image); ?>" alt="">
                            <h3><?php echo $teacher->name; ?></h3>
                        </div>
                    </a>
            <?php
                }
            } ?>
        </div>
    </div>

</div>

@endsection