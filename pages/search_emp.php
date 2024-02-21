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
        <th>Employee</th>
        <th>Job Title</th>
        <th>Department</th>
        <th>Salary</th>
        <th>Hure Date</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>National_id</th>
        <th>Address</th>
        <th>Added By</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>

    <?php
        $get_emp = $conn -> query("SELECT emp_id, emp_name, job_title, dept_name, salary, hire_date,
        emp_mob, emp_email, emp_age, emp_gender, national_id, emp_address, user_username
        FROM (((( employees
            INNER JOIN jobs USING(job_id))
            INNER JOIN departments USING(dept_id))
            CROSS JOIN contacts ON employees.emp_id = contacts.con_id)
            INNER JOIN heart_usere ON employees.user_userid = heart_usere.user_userid)
            WHERE emp_active = 1 AND emp_name LIKE('%$sec_data%')");
        while($row = $get_emp -> fetch()):

   
        
    ?> 
        
 
        <tr>
            <td><?php echo $row['emp_name']; ?></td>
            <td><?php echo $row['job_title']; ?></td>
            <td><?php echo $row['dept_name']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            <td><?php echo $row['hire_date']; ?></td>
            <td><?php echo $row['emp_mob']; ?></td>
            <td><?php echo $row['emp_email']; ?></td>
            <td><?php echo $row['emp_age']; ?></td>
            <td><?php echo $row['emp_gender']; ?></td>
            <td><?php echo $row['national_id']; ?></td>
            <td><?php echo $row['emp_address']; ?></td>
            <td><?php echo $row['user_username']; ?></td>

            <td class="edit">
                <form action="editemp.php" method="GET">
                    <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                    <button><i class="fas fa-edit"></i></button>
                </form>
            </td>
            <td class="trash">
                <form action="delemp.php" method="GET">
                    <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                    <button><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>

    <?php endwhile; ?>

</table>