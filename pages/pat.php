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

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search">
        </div>
        <div class="addbox">
            <a href="add_pat.php">Add patient</a>
        </div>
    </div>

    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>patient</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Treatment Doctor</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif;?>
            </tr>

            <?php
                $get_pat = $conn -> query("SELECT pat_id, pat_name, pat_phone, pat_gender,
                pat_age, treat_name, user_username
                FROM (( patients
                        INNER JOIN treat_doctors USING(treat_id)) 
                        INNER JOIN heart_usere ON patients.user_userid = heart_usere.user_userid)
                WHERE pat_active = 1");
                while($row = $get_pat -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['pat_name']; ?></td>
                    <td><?php echo $row['pat_phone']; ?></td>
                    <td><?php echo $row['pat_gender']; ?></td>
                    <td><?php echo $row['pat_age']; ?></td>
                    <td><?php echo $row['treat_name']; ?></td>
                    <td><?php echo $row['user_username']; ?></td>

                    <?php if($_SESSION['usertype'] == 'admin'):?>
                        <td class="edit">
                            <form action="editpat.php" method="GET">
                                <input type="hidden" name="pat_id" value="<?php echo $row['pat_id']; ?>">
                                <button><i class="fas fa-edit"></i></button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delpat.php" method="GET">
                                <input type="hidden" name="pat_id" value="<?php echo $row['pat_id']; ?>">
                                <button><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif;?>
                </tr>

            <?php endwhile; ?>
        </table>
    </div>


</div>

<?php
    include "../master/sections/foot.php";
?>

<script src="../master/js/pat_search.js"></script>

<?php
    include "../master/sections/end.php";
    
?>