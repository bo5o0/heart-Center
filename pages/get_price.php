<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

    $exam_id = $_GET['q'];

    $exam_price = $conn -> query("SELECT exam_price FROM examinations 
    WHERE exam_id = $exam_id") ->fetchAll(PDO::FETCH_COLUMN);


    echo $exam_price[0];
