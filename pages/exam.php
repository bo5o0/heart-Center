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
    <div class="page-title">Examinations</div>

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search">
        </div>
        <div class="addbox">
            <a href="add_exam.php">Add Examinations</a>
        </div>
    </div>

    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>ID</th>
                <th>Examinations</th>
                <th>Prcie</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif;?>
            </tr>

            <?php
                $get_exam = $conn -> query("SELECT exam_id, exam_name, exam_price, user_username
                FROM examinations INNER JOIN heart_usere USING(user_userid)
                WHERE exam_active = 1");
                while($row = $get_exam -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['exam_id']; ?></td>
                    <td><?php echo $row['exam_name']; ?></td>
                    <td><?php echo $row['exam_price']; ?></td>
                    <td><?php echo $row['user_username']; ?></td>

                    <?php if($_SESSION['usertype'] == 'admin'):?>
                        <td class="edit">
                            <form action="editexam.php" method="GET">
                                <input type="hidden" name="exam_id" value="<?php echo $row['exam_id']; ?>">
                                <button><i class="fas fa-edit"></i></button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delexam.php" method="GET">
                                <input type="hidden" name="exam_id" value="<?php echo $row['exam_id']; ?>">
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

<script src="../master/js/exam_search.js"></script>

<?php
    include "../master/sections/end.php";
    
?>