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
        $job = $_POST['job'];
        $job_ID = $_POST['job_id'];
        $userID = $_SESSION['userid'];

        $stmt = $conn -> prepare("UPDATE jobs SET job_title = ?, user_userid =? 
        WHERE job_id = $job_ID");
        $stmt -> execute([$job, $userID]);
        header("location:job.php");
    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Jobs</div>

    <?php
        $job_id = $_GET['job_id'];
        $job_info = $conn -> query("SELECT * FROM jobs
        WHERE job_id = $job_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="hidden" name="job-id" value="<?php echo $job_info[0]['job_id']; ?>">
                <div class="form-row">
                    <span>Job Title:</span>
                    <input type="text" name="job" value="<?php echo $job_info[0]['job_title'];?>">
                </div>

                <div class="form-row">
                    <input type="submit" value="Edit job">
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
