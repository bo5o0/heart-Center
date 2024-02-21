<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Reports</div>


</div>

<?php
    include "../master/sections/foot.php";
?>

<?php
    include "../master/sections/end.php";
    
?>