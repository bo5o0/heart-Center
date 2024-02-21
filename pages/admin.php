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
    <div class="page-title">Dashboard</div>
    <!-- page content -->

    <div class="content">

        <div class="c-1">
            <samp>Patient</samp>
            <?php
                $patient_count = $conn -> query("SELECT COUNT(pat_id)
                FROM Patients WHERE pat_active = 1") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <samp><?php echo $patient_count[0];?></samp>
        </div>

        <div class="c-2">
            <samp>Treatment Doctors</samp>
            <?php
                $treat_count = $conn -> query("SELECT COUNT(treat_id)
                FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <samp><?php echo $treat_count[0];?></samp>
        </div>

        <div class="c-3">
            <samp>Employees</samp>
            <?php
                $emp_count = $conn -> query("SELECT COUNT(emp_id)
                FROM employees WHERE emp_active = 1") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <samp><?php echo $emp_count[0];?></samp>
        </div>

        <div class="c-4">
            <samp>Total Incame</samp>
            <?php
                $incame = $conn -> query("SELECT SUM(invoice_total)
                FROM invoice WHERE invoice_active = 1") -> fetchAll(PDO::FETCH_COLUMN);
                $total_incame = (gettype($incame[0]) == NULL) ? 0 : $incame[0];
            ?>
            <samp><?php echo $total_incame . 'L.E';?></samp>
        </div>

        <div class="c-5">
            <samp>Total Examination</samp>
            <?php
                $exam_count = $conn -> query("SELECT COUNT(detail_id)
                FROM details") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <samp><?php echo $exam_count[0];?></samp>
        </div>

        <div class="c-6">
            <samp>Last Invoice Date</samp>
            <?php
                $last_date = $conn -> query("SELECT invoice_date FROM invoice 
                ORDER BY invoice_id DESC LIMIT 1") -> fetchAll(PDO:: FETCH_COLUMN);
                $last_invoice = (count($last_date) > 0) ? $last_date[0] : "Empty";
           
            ?>
            <samp><?php echo $last_invoice; ?></samp>

        </div>
    </div>
</div>

<?php
    include "../master/sections/foot.php";
?>

<?php
    include "../master/sections/end.php";
?>


