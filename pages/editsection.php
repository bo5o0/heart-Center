<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    include "../master/sections/connect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $section = $_POST['section'];
        $section_ID = $_POST['section-id'];
        $userID = $_SESSION['userid'];

        $stmt = $conn -> prepare("UPDATE sections SET section_name = ?, user_userid =? 
        WHERE section_id = $section_ID");
        $stmt -> execute([$section, $userID]);
        header("location:section.php");
    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">section</div>

    <?php
        $section_id = $_GET['section_id'];
        $section_info = $conn -> query("SELECT * FROM sections
        WHERE section_id = $section_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="hidden" name="section-id" value="<?php echo $section_info[0]['section_id']; ?>">
                <div class="form-row">
                    <span>Section Name:</span>
                    <input type="text" name="section" value="<?php echo $section_info[0]['section_name'];?>">
                </div>

                <div class="form-row">
                    <input type="submit" value="Edit section">
                </div>

            </form>

            <?php

            ?>
        </div>

</div>    

<?php
    include "../master/sections/foot.php";
?>

<?php
    include "../master/sections/end.php";
?>
