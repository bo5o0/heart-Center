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
    <div class="page-title">Jobs</div>

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search">
        </div>
        <div class="addbox">
            <a href="add_job.php">Add Job</a>
        </div>
    </div>

    <div class="tab" id="search-result">
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
                WHERE job_active = 1");
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
    </div>



</div>

<?php
    include "../master/sections/foot.php";
?>

<script src="../master/js/job_search.js"></script>

<?php
    include "../master/sections/end.php";
    
?>