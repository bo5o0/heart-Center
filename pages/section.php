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
    <div class="page-title">section</div>

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search">
        </div>
        <div class="addbox">
            <a href="add_section.php">Add sections</a>
        </div>
    </div>

    <div class="tab" id="search-result">
        <table>        
            <tr>
                <th>ID</th>
                <th>Section</th>
                <th>Added by</th>
                <?php if($_SESSION['usertype'] == 'admin'):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif;?>
            </tr>
            
            <?php
                $get_sections = $conn -> query("SELECT section_id, section_name, user_username
                FROM sections INNER JOIN heart_usere USING(user_userid)
                WHERE section_active = 1");
                while($row = $get_sections -> fetch()):
            ?>
                <tr>
                    <td> <?php echo $row['section_id']; ?> </td>
                    <td> <?php echo $row['section_name']; ?> </td>
                    <td> <?php echo $row['user_username']; ?> </td>
             
                    <?php if($_SESSION['usertype'] == 'admin'):?>
                        <td class="edit">
                            <form action="editsection.php" method="GET">
                                <input type="hidden" name="section_id" value="<?php echo $row['section_id']; ?>">
                                <button><i class="fas fa-edit"></i></button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delsection.php" method="GET">
                                <input type="hidden" name="section_id" value="<?php echo $row['section_id']; ?>">
                                <button><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif;?>
                </tr>      
                <?php endwhile;?>
        </table>
    </div>

</div>

<?php
    include "../master/sections/foot.php";
?>
<!-- custome js -->
<script src="../master/js/section_search.js"></script>

<?php
    include "../master/sections/end.php";
    
?>

