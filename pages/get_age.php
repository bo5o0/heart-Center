<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

$pat_id = $_GET['q'];

$pat_age = $conn -> query("SELECT pat_age FROM patients
WHERE pat_id=  $pat_id") ->fetchAll(PDO::FETCH_COLUMN);


echo $pat_age[0];

