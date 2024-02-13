<?php
$host = "localhost";
$user = "";
$pass = "";
$dbname = "";
//Create connection

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("Connection failed");
}


?>
