<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbName = "login_register";
$dbPort = "3304";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, $dbPort);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
