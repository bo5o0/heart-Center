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
        $dept = $_POST['dept'];
        $deptID = $_POST['dept_id'];
        $userID = $_SESSION['userid'];

        $stmt = $conn -> prepare("UPDATE departments SET dept_name = ?, user_userid =? 
        WHERE dept_id = $deptID;");
        $stmt -> execute([$dept, $userID]);
        header("location:dept.php");
    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Departments</div>

    <?php
        $dept_id = $_GET['dept_id'];
        $dept_info = $conn -> query("SELECT * FROM departments
        WHERE dept_id = $dept_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="hidden" name="dept-id" value="<?php echo $dept_info[0]['dept_id']; ?>">
                <div class="form-row">
                    <span>Section Name:</span>
                    <input type="text" name="department" value="<?php echo $dept_info[0]['dept_name'];?>">
                </div>

                <div class="form-row">
                    <input type="submit" value="Edit department">
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
