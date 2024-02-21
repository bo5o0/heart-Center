<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    
    include "../master/sections/connect.php";

    if( $_SERVER["REQUEST_METHOD"] == 'POST' ){
        $emp = $_POST['emp'];
        $job = $_POST['job'];
        $dept = $_POST['dept'];
        $salary = $_POST['salary'];
        $hdate = $_POST['hdate'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $nid = $_POST['nid'];
        $userID = $_SESSION['userid'];

    
        $last_emp = $conn -> query("SELECT emp_id FROM employees ORDER BY emp_id
        DESC LIMIT 1") -> fetchAll(PDO::FETCH_COLUMN);

        $con_id = (count($last_emp) > 0) ? $last_emp[0] + 1 : 1;



        $stmt = $conn -> prepare("INSERT INTO contacts(con_id ,emp_mob, emp_email, emp_address)
        VALUES(?,?,?,?)");
        $stmt -> execute([$con_id, $phone, $email, $address]); 


        $stmt2 = $conn -> prepare("INSERT INTO employees(emp_name, job_id, dept_id, salary, hire_date, emp_age,
        emp_gender, national_id, user_userid) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt2 -> execute([$emp, $job, $dept, $salary, $hdate, $age, $gender, $nid, $userID]);

        header("location:emp.php");

    }

    include "../master/sections/start.php";

    include "../master/sections/links.php";

    include "../master/sections/header.php";

?>

<div class="data">
    <div class="page-title">Employees</div>


        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

                <div class="form-row">
                    <span>Employee Name:</span>
                    <input type="text" name="emp" placeholder="employee name">
                </div>
                
                
                <div class="form-row">
                    <span>Job Title:</span>
                    <select name="job" id="">
                        <option value="">Select job</option>
                        <?php
                            $get_job = $conn -> query("SELECT job_id, job_title FROM jobs
                            WHERE job_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                            foreach($get_job as $key => $value){
                                echo "<option value=\"$key\">$value</option>";
                            }
                        ?>
                    </select>
                </div>

                
                <div class="form-row">
                    <span>Department Name:</span>
                    <select name="dept" id="">
                        <option value="">Select department</option>
                        <?php
                            $get_dept = $conn -> query("SELECT dept_id, dept_name FROM departments
                            WHERE dept_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                            foreach($get_dept as $key => $value){
                                echo "<option value=\"$key\">$value</option>";
                            }
                        ?>
                    </select>
                </div>

                
                <div class="form-row">
                    <span>Employee Salary:</span>
                    <input type="number" name="salary" placeholder="salary">
                </div>

                
                <div class="form-row">
                    <span>Hire Date:</span>
                    <input type="date" name="hdate">
                </div>

                
                <div class="form-row">
                    <span>Employee Phone:</span>
                    <input type="tel" name="phone" placeholder="employee phone">
                </div>

                
                <div class="form-row">
                    <span>Employee Email:</span>
                    <input type="email" name="email" placeholder="employee email">
                </div>
           
                
                <div class="form-row">
                    <span>Employee Address:</span>
                    <input type="text" name="address" placeholder="employee address">
                </div>


                <div class="form-row">
                    <span>Employee Age:</span>
                    <input type="number" name="age" placeholder="employee age">
                </div>

                
                <div class="form-row">
                    <span>Employee Gender:</span>
                    <select name="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                  
                <div class="form-row">
                    <span>National ID:</span>
                    <input type="text" name="nid" placeholder="national ID">
                </div>


                <div class="form-row">
                    <input type="submit" value="Add Employee">
                </div>

            </form>

        </div>



</div>    

<?php
    include "../master/sections/foot.php";
?>

<?php
    include "../master/sections/end.php";
?>
