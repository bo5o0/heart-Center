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
    <div class="page-title">Treatment Doctors</div>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <div class="form-row">
                    <span>Doctors Name:</span>
                    <input type="text" name="treat" placeholder="Doctors name">
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
                    <span>Address:</span>
                    <input type="text" name="Address" placeholder="Address">
                </div>

                <div class="form-row">
                    <span>Sections:</span>
                    <select name="section">
                        <option value="">select</option>
                        <?php
                            $section_data = $conn -> query("SELECT section_id, section_name
                            FROM sections WHERE section_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                            foreach($section_data as $key => $value):
                        ?>
                        <option value="<?php echo $key?>"><?php echo $value;?></option>
                        <?php endforeach; ?>
                    </select>
            
                </div>

                <div class="form-row">
                    <input type="submit" value="Add Doctor">
                </div>

            </form>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $treat = $_POST['treat'];
                    $mob = $_POST['mob'];
                    $gender = $_POST['gender'];
                    $Address = $_POST['Address'];
                    $section = $_POST['section'];
                    $userID = $_SESSION['userid'];

                    if(empty($treat) || empty($mob) || empty($gender) || empty($Address) || empty($section)){
                        echo "<div class=\"error\">Enter data to save doctor.</div>";
                    }
                    else{
                        $stmt = $conn -> prepare("INSERT INTO treat_doctors(treat_name, treat_phone, treat_gender, treat_address, section_id, user_userid) VALUES(?,?,?,?,?,?)");
                        $stmt -> execute([$treat, $mob, $gender, $Address, $section, $userID]);
                        header("location:treat.php");
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
