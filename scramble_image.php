<?php
    if(!isset($_COOKIE["user_id"]) || $_COOKIE["user_id"] < 0){
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrambling Image Puzzle</title>
    <link rel="stylesheet" href="scramble.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
	<form action="logout.php" method="post" class="logout-button" onclick="return onLogoutClick(); ">
        <button type="submit" id="logout">Logout</button>
    </form>
    <div class="container">
        <canvas id="canvas" width="400" height="400"></canvas>
    </div>
	<label for="difficulty">Grid size</label>
<input type="range" min="2" max="16" value="4" id="difficulty" />
    <script src="scramble.js"></script>
</body>
</html>
