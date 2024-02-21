<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";

$pat_id = $_GET['q'];

$pat_treat = $conn -> query("SELECT pat_id, treat_name FROM patients INNER JOIN treat_doctors USING(treat_id)
WHERE pat_id = $pat_id") ->fetchAll(PDO::FETCH_KEY_PAIR);


echo $pat_treat[$pat_id];

