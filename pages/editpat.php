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
        $pat = $_POST['pat'];
        $pat_ID = $_POST['pat_id'];
        $userID = $_SESSION['userid'];

        $stmt = $conn -> prepare("UPDATE patients SET pat_name =? , pat_phone =?, pat_gender = ?, pat_age =? , treat_id =?, user_userid =? 
        WHERE pat_id = $pat_ID");
        $stmt -> execute([$pat, $userID]);
        header("location:pat.php");
    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">patients</div>

    <?php
        $pat_id = $_GET['pat_id'];
        $pat_info = $conn -> query("SELECT * FROM patients
        WHERE pat_id = $pat_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <input type="hidden" name="pat-id" value="<?php echo $pat_info[0]['pat_id']; ?>">
                <div class="form-row">
                    <span>patient Name:</span>
                    <input type="text" name="patient" value="<?php echo $pat_info[0]['pat_name'];?>">
                </div>

                <div class="form-row">
                    <span>phone:</span>
                    <input type="text" name="mob" value="<?php echo $pat_info[0]['pat_phone'];?>">
                </div>

                <div class="form-row">
                    <span>Gender:</span>
                    <select name="gender">
                        <option value="">Select</option>
                        <option value="Male" <?php if($pat_info[0]['pat_gender'] == 'male'){ echo "selected=\"selected\"";} ?> >Male</option>
                        <option value="Female" <?php if($pat_info[0]['pat_gender'] == 'female'){ echo "selected=\"selected\"";} ?>>Female</option>
                    </select>
                </div>

                <div class="form-row">
                    <span>Age:</span>
                    <input type="text" name="age" value="<?php echo $pat_info[0]['pat_age'];?>">
                </div>



                <div class="form-row">
                    <input type="submit" value="Edit patient">
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
