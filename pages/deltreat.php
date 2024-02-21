<?php
session_start();
if(!isset($_SESSION['user'])){
    header("location:../index.php");
}
elseif( $_SESSION['usertype'] != 'admin'){
    header("location:out.php");
}
include "../master/sections/connect.php";

$t_id = $_GET['treat_id'];

$stmt = $conn -> prepare("UPDATE treat_doctors SET treat_active = 0 WHERE treat_id = $t_id");

$stmt -> execute();

header("location:treat.php");
