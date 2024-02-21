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
        $treat = $_POST['treat'];
        $treatID = $_POST['treat-id'];
        $mob = $_POST['mob'];
        $gender = $_POST['gender'];
        $Address = $_POST['Address'];
        $section = $_POST['section'];
        $userID = $_SESSION['userid'];

        $stmt = $conn -> prepare("UPDATE treat_doctors SET treat_name = ? , treat_phone = ?, treat_gender = ? , 
        treat_address = ?, section_id = ?, user_userid = ? WHERE treat_id = $treatID");
        $stmt -> execute([$treat, $mob, $gender, $Address, $section, $userID]);
        header("location:treat.php");
    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Treatment Doctors</div>

    <?php
        $treat_id = $_GET['treat_id'];
        $treat_info = $conn -> query("SELECT * FROM treat_doctors
        WHERE treat_id = $treat_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <input type="hidden" name="treat-id" value="<?php echo $treat_info[0]['treat_id'];?>">

                <div class="form-row">
                    <span>Doctors Name:</span>
                    <input type="text" name="treat" value="<?php echo $treat_info[0]['treat_name'];?>">
                </div>

                <div class="form-row">
                    <span>Phone:</span>
                    <input type="tel" name="mob" value="<?php echo $treat_info[0]['treat_phone'];?>">
                </div>

                <div class="form-row">
                    <span>Gender:</span>
                    <select name="gender">
                        <option value="">Select</option>
                        <option value="Male" <?php if($treat_info[0]['treat_gender'] == 'male'){ echo "selected=\"selected\"";} ?> >Male</option>
                        <option value="Female" <?php if($treat_info[0]['treat_gender'] == 'female'){ echo "selected=\"selected\"";} ?>>Female</option>
                    </select>
                </div>

                <div class="form-row">
                    <span>Address:</span>
                    <input type="text" name="Address" value="<?php echo $treat_info[0]['treat_address']; ?>">
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
                            <?php if($key == $treat_info[0]['section_id']):?>
                                <option value="<?php echo $key;?>" selected="selected"><?php echo $value;?></option>
                            <?php else: ?>
                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </select>
            
                </div>

                <div class="form-row">
                    <input type="submit" value="Edit Doctor">
                </div>

            </form>

            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $treatID = $_POST['treat-id'];
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
