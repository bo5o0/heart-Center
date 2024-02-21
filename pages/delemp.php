<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$e_id = $_GET['emp_id'];

$stmt = $conn -> prepare("UPDATE employees SET emp_active = 0 WHERE emp_id = $e_id");

$stmt -> execute();

header("location:emp.php");
