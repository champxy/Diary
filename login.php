<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/inputlogin.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.css">
  <title>Document</title>
</head>

<body>
  <form action="validation.php" method="post" id="login">
    <div class="login-container">
      <div class="login-card">
        <h1>Log in</h1>
        <form>
          <div class="input-group">
            <label for="Username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
          </div>
          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>
          <button type="submit" name="login" id="login" value="login" onclick="login()" class="login-btn">Log in</button>
        </form>
        <div class="login-links">

          <a href="register.php">Create an account</a>
        </div>
      </div>
    </div>

  </form>
</body>
<script src="js/swal.js"></script>

</html>