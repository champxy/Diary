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
    <script src="js/input.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.css">
    <title>Document</title>
</head>
<body>
<div class="login-container">
  <div class="login-card">
    <h1>Register</h1>

      <div class="input-group">
        <label for="Username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="input-group">
        <label for="Username">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your username" required>
      </div>
      <div class="input-group">
        <label for="Username">Sername</label>
        <input type="text" id="sername" name="sername" placeholder="Enter your username" required>
      </div>
      <button type="submit"  class="login-btn"  onclick="exec_post()">Register</button>
   
    
  </div>
</div>
</body>
</html>