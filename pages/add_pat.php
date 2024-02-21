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
    <div class="page-title">patients</div>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <div class="form-row">
                    <span>patient Name:</span>
                    <input type="text" name="pat" placeholder="patient name">
                </div>

                <div class="form-row">
                    <span>Phone:</span>
                    <input type="tel" name="mob" placeholder="phone">
                </div>

                <div class="form-row">
                    <span>Gender:</span>
                    <select name="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-row">
                    <span>Age:</span>
                    <input type="number" name="age" placeholder="age">
                </div>

                <div class="form-row">
                    <span>Treatment Doctors:</span>
                    <select name="treat">
                        <option value="">select</option>
                        <?php
                            $treat_data = $conn -> query("SELECT treat_id, treat_name
                            FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                            foreach($treat_data as $key => $value):
                        ?>
                        <option value="<?php echo $key?>"><?php echo $value;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <input type="submit" value="Add patient">
                </div>
            </form>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $pat = $_POST['pat'];
                    $mob = $_POST['mob'];
                    $gender = $_POST['gender'];
                    $Age = $_POST['age'];
                    $treat = $_POST['treat'];
                    $userID = $_SESSION['userid'];

                    if(empty($pat) || empty($mob) || empty($gender) || empty($Age) || empty($treat)){
                        echo "<div class=\"error\">Enter data to save patient.</div>";
                    }
                    else{
                        $stmt = $conn -> prepare("INSERT INTO patients(pat_name, pat_phone, pat_gender, pat_age, treat_id, user_userid)
                        VALUES(?,?,?,?,?,?)");
                        $stmt -> execute([$pat, $mob, $gender, $Age, $treat, $userID]);
                        header("location:pat.php");
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
