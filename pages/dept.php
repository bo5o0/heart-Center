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

    
    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search">
        </div>
        <div class="addbox">
            <a href="add_dept.php">Add Department</a>
        </div>
    </div>

    <div class="tab" id="search-result">
        <table>
            <tr>
                <th>ID</th>
                <th>Departments Name</th>
                <th>Added By</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
                $get_dept = $conn -> query("SELECT dept_id, dept_name, user_username
                FROM  Departments INNER JOIN heart_usere USING (user_userid )
                WHERE dept_active = 1");
                while($row = $get_dept -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['dept_id']; ?></td>
                    <td><?php echo $row['dept_name']; ?></td>
                    <td><?php echo $row['user_username']; ?></td>

                    <td class="edit">
                        <form action="editdept.php" method="GET">
                            <input type="hidden" name="dept_id" value="<?php echo $row['dept_id']; ?>">
                            <button><i class="fas fa-edit"></i></button>
                        </form>
                    </td>
                    <td class="trash">
                        <form action="deldept.php" method="GET">
                            <input type="hidden" name="dept_id" value="<?php echo $row['dept_id']; ?>">
                            <button><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

            <?php endwhile; ?>
        </table>
    </div>




</div>

<?php
    include "../master/sections/foot.php";
?>

<script src="../master/js/dept_search.js"></script>

<?php
    include "../master/sections/end.php";
    
?>