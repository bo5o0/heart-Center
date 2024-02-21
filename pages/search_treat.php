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
        <th>Treatment Doctor</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Section</th>
        <th>Added By</th>
        <?php if($_SESSION['usertype'] == 'admin'):?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif;?>
    </tr>

    <?php
        $get_treat = $conn -> query("SELECT treat_id, treat_name, treat_phone, treat_gender,
        treat_address, section_name, user_username
        FROM (( treat_doctors
                INNER JOIN sections USING(section_id)) 
                INNER JOIN heart_usere ON sections.user_userid = heart_usere.user_userid)
        WHERE treat_active = 1 AND treat_name LIKE('%$sec_data%')");
        while($row = $get_treat -> fetch()):
    ?>
        <tr>
            <td><?php echo $row['treat_name']; ?></td>
            <td><?php echo $row['treat_phone']; ?></td>
            <td><?php echo $row['treat_gender']; ?></td>
            <td><?php echo $row['treat_address']; ?></td>
            <td><?php echo $row['section_name']; ?></td>
            <td><?php echo $row['user_username']; ?></td>

            <?php if($_SESSION['usertype'] == 'admin'):?>
                <td class="edit">
                    <form action="edittreat.php" method="GET">
                        <input type="hidden" name="treat_id" value="<?php echo $row['treat_id']; ?>">
                        <button><i class="fas fa-edit"></i></button>
                    </form>
                </td>
                <td class="trash">
                    <form action="deltreat.php" method="GET">
                        <input type="hidden" name="treat_id" value="<?php echo $row['treat_id']; ?>">
                        <button><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            <?php endif;?>
        </tr>

    <?php endwhile; ?>
</table>