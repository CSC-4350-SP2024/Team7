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
      <form id="signup-form" action="submit.php" method="post" onsubmit="return validateForm()">
        <div class="form-group">
          <small> 
        <?php if(isset($usernameErr)) { echo $usernameErr;} ?>
        <?php if(isset($passwordErr)) { echo $passwordErr;} ?>
        <?php if(isset($emailErr)) { echo $emailErr;} ?>
		 </small>
		 <small></small>
		 </div>
		 <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
		  <small> <span id="usernameErr"></span> </small>
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
		  <small> <span id="emailErr"></span> </small>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
		  <small><span id="passwordErr"></span></small> 
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
		  <small> <span id="confirmPassErr"></span> </small>
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
