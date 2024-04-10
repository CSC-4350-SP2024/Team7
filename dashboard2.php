<?php
include 'connectDB.php';

if (!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard 2</title>
    <link rel="stylesheet" href="dashboard.css">
	
</head>
<body>
    <div class="logo2">
        <a href="index.html">
            <img src="logo2.3.png" alt="logo">
            <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;"></span>
        </a>
    </div>
    <form action="logout.php" method="post" class="logout-button" onclick="return onLogoutClick(); ">
        <button type="submit" id="logout">Logout</button>
    </form>
<?php
include("connectToDB.php");

if (!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM saved_puzzle_states WHERE user_id = " . $_COOKIE["user_id"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4 mb-4'>";
        echo "<div class='card' style='background-image: url(\"" . $row['image_path'] . "\")'>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='col-12 text-center'><p>No saved puzzle images found.</p></div>";
}

$conn->close();
?>
        <div class="card">
            <a href="add_password.php"><span class="plus">+</span></a>
        </div>
    </div>
</body>
</html>


