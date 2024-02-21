<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$e_id = $_GET['exam_id'];

$stmt = $conn -> prepare("UPDATE examinations SET exam_active = 0 WHERE exam_id = $e_id");
$stmt -> execute();
header("location:exam.php");


