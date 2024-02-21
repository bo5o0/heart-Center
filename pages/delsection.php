<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$s_id = $_GET['section_id'];

$stmt = $conn -> prepare("UPDATE sections SET section_active = 0 WHERE section_id = $s_id");
$stmt -> execute();
header("location:section.php");


