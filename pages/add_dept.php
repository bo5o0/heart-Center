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
    <div class="page-title">Departments</div>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <div class="form-row">
                    <span>Department Name:</span>
                    <input type="text" name="dept" placeholder="Department">
                </div>

                <div class="form-row">
                    <input type="submit" value="Add Department">
                </div>

            </form>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $dept = $_POST['dept'];
                    $userID = $_SESSION['userid'];

                    if(empty($dept)){
                        echo "<div class=\"error\">Enter Department name to save Department.</div>";
                    }
                    else{
                        $stmt = $conn -> prepare("INSERT INTO Departments(dept_name, user_userid) VALUES(?,?)");
                        $stmt -> execute([$dept, $userID]);
                        header("location:dept.php");
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
