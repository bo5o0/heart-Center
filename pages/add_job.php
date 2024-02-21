<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    include "../master/sections/connect.php";

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Jobs</div>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <div class="form-row">
                    <span>Job Title:</span>
                    <input type="text" name="job" placeholder="job title">
                </div>

                <div class="form-row">
                    <input type="submit" value="Add Job">
                </div>
            </form>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $job = $_POST['job'];
                    $userID = $_SESSION['userid'];

                    if(empty($job)){
                        echo "<div class=\"error\">Enter jobs title to save job.</div>";
                    }
                    else{
                        $stmt = $conn -> prepare("INSERT INTO jobs(job_title, user_userid)
                        VALUES(?,?)");
                        $stmt -> execute([$job, $userID]);
                        header("location:job.php");
                    }
                }
            ?>
        </div>
</div>    

<?php
    include "../master/sections/foot.php";
?>

<?php
    include "../master/sections/end.php";
?>
