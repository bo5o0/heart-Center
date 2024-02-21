<?php
/*
    $obj = new PDO("mysql:hostname=..;dbname=...", username, password);
*/

$hostname = "localhost";
$dbname = "heart_center";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:hostname=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    /* -> Object operator in php like . in javascript */
}
