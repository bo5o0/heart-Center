<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $pat = $_POST['pat'];
        $invoiceID = $_POST['invoid'];
        $invoice_date = $_POST['invdate'];
        $invoice_time = $_POST['invtime'];
        $exams = $_POST['exam'];
        $prices = $_POST['price'];
        $discounts = $_POST['discont'];
        $amounts = $_POST['amount'];
        $invoice_total = $_POST['total'];
        $emp = $_POST['emp'];
        $userID = $_SESSION['userid'];


        function exam_filter($txt){
            return $txt != "start";
        }
        $activeExams = array_filter($exams, "exam_filter");
   
        $stmt = $conn -> prepare("INSERT INTO invoice(invoice_id, pat_id, invoice_date, invoice_time,
        invoice_total, emp_id, user_userid)VALUES(?,?,?,?,?,?,?)");
        $stmt -> execute([$invoiceID, $pat, $invoice_date, $invoice_time, $invoice_total, $emp, $userID]);

        for( $i = 0; $i < count($activeExams); $i++){
            $stmt2 = $conn -> prepare("INSERT INTO details(invoice_id, exam_id, price, discount)
            VALUES(?,?,?,?)");
            $stmt2 -> execute([$invoiceID, $activeExams[$i], $prices[$i], $discounts[$i]]);
        }

        if($_SESSION['usertype'] == 'admin'){
            header("location:admin.php");
        }
        else{
            header("location:user.php");
        }


    }