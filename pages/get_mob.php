<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

$pat_id = $_GET['q'];

$pat_phone = $conn -> query("SELECT pat_phone FROM patients
WHERE pat_id=  $pat_id") ->fetchAll(PDO::FETCH_COLUMN);


echo $pat_phone[0];

