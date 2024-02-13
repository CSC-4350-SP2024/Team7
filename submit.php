<?php

$host = "localhost";
$user = "";
$pass = "";
$dbname = "";

// create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$users = "CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL, -- Increase the length for hashed passwords
    user_email VARCHAR(100) NOT NULL
)";

if ($conn->query($users) === TRUE) {
    echo "Table USERS created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>
