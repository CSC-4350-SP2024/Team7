<?php
session_start();
include("connectDB.php");

// Handles the login form submission
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $sql = "SELECT * FROM users WHERE user_name = '$username'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);
  if ($user) {
    if (password_verify($password, $user["user_password"])) {
      $_SESSION["username"] = $username;
      header("Location: index.html");
      exit();
    } else {
      $passwordErr = "<p>Please enter password correctly.</p>";
    }
  } else {
    $usernameErr = "<p> Please enter username correctly.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="logo">
  <a href="index.html">
        <img src="logo2.3.png" alt="logo">
        <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;"></span>
	</a>
  </div>
  <div class="container">
    <div class="login-container">
      <div class="header">
        <h3>Login</h3>
      </div>
      <form action="" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
          <small><?php if (isset($usernameErr)) { echo $usernameErr; } ?></small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
          <small><?php if (isset($passwordErr)) { echo $passwordErr; } ?></small>
        </div>
        <button type="submit" name="login" class="btn">Login</button>
        <div class="form-box">
          <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
