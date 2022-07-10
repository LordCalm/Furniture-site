<?php
$hostname = "localhost";
$username = "furniture_site";
$password = "JxSLRkdutW";
$db = "furniture";

$dbconnect = mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
    die("Database connection failed: " . $dbconnect->connect_error);
}
?>