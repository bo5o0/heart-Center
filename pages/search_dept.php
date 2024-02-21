<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    
    $sec_data = $_GET['q'];

?>    


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
        WHERE dept_active = 1 AND dept_id AND dept_name LIKE('%$sec_data%')");
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