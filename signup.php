<?php
include("connectDB.php");

$usernameErr = $passwordErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $password = test_input($_POST["password"]);
  $confirmPassword = test_input($_POST["confirmPassword"]);
  $email = test_input($_POST["email"]);
  $type = $_POST["type"];

  $name_query = "SELECT * FROM users WHERE user_name = '$username'";
  $name_result = mysqli_query($conn, $name_query);
  $usernameExists = mysqli_num_rows($name_result) > 0;

  $email_query = "SELECT * FROM users WHERE user_email = '$email'";
  $email_result = mysqli_query($conn, $email_query);
  $emailExists = mysqli_num_rows($email_result) > 0;

  if ($password !== $confirmPassword) {
    $passwordErr = "Passwords do not match";
  }

  if (!$usernameExists && !$emailExists && empty($passwordErr)) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, user_password, user_email, user_type) VALUES ('$username', '$passwordHash', '$email', '$type')";
    mysqli_query($conn, $sql);
    header("Location: login.php");
    exit();
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up Page</title>
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
        <h3>Sign up</h3>
      </div>
      <hr>
      <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        <div class="form-group">
          <small><?php if ($usernameErr) { echo $usernameErr; } ?></small>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
          <small><?php if ($emailErr) { echo $emailErr; } ?></small>
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
          <small><?php if ($passwordErr) { echo $passwordErr; } ?></small>
        </div>
        <button type="submit" class="btn">Sign up</button>
        <div class="form-box">
          <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
