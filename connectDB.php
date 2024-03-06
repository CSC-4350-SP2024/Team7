<?php
$host = "localhost";
$user = "jlopez48";
$pass = "jlopez48";
$dbname = "jlopez48";
//Create connection

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("Connection failed");
}


?>
