<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
<script src="assets/js/dashboard.js"></script>
<script>
       function modalShow(id) {
        $("#" + id).show();
        $("#" + id).css("opacity", "1");
    }
    function modalclose(id) {
        $("#" + id).hide();
        $("#" + id).css("opacity", "0");
    }


    function shower(hider,shower,active){
        $(".p-active").removeClass('p-active');
        $(active).addClass('p-active');
        $(hider).css("display","none");
        $(shower).css("display","flex");
    }

    // // preview
function clicker(input) {
    $("#" + input).click();
}

function previewImage(event, preview) {
    console.log(event);
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById(preview);

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>