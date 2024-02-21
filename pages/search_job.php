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
        <th>Job Title</th>
        <th>Added By</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
        $get_job = $conn -> query("SELECT job_id, job_title, user_username
        FROM  jobs INNER JOIN heart_usere USING (user_userid )
        WHERE job_active = 1 AND job_id AND job_title LIKE('%$sec_data%')");
        while($row = $get_job -> fetch()):
    ?>
        <tr>
            <td><?php echo $row['job_id']; ?></td>
            <td><?php echo $row['job_title']; ?></td>
            <td><?php echo $row['user_username']; ?></td>

            <td class="edit">
                <form action="editjob.php" method="GET">
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button><i class="fas fa-edit"></i></button>
                </form>
            </td>
            <td class="trash">
                <form action="deljob.php" method="GET">
                    <input type="hidden" name="job_id" value="<?php echo $row['job_id']; ?>">
                    <button><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>

    <?php endwhile; ?>
</table>