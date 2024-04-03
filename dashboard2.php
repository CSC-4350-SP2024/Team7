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
    
    <div class="container">
			<?php
			
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-4'>";
                        echo "<div class='card'>";
                        echo "<img src='path_to_images/{$row['image']}' class='card-img-top' alt='Image'>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text'>Password: {$row['password']}</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12 text-center'><p>No image passwords found.</p></div>";
                }
            ?>
        <div class="card">
            <a href="add_password.php"><span class="plus">+</span></a>
        </div>
    </div>
</body>
</html>
