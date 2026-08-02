<?php
session_start();
include 'inc/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library Management System</title>
  <link rel="stylesheet" href="inc/css/bootstrap.min.css">
  <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Montserrat', sans-serif;
    }

    .login {
      background: url('inc/img/login-background.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .reg-header h1 {
      color: white;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
    }

    .login-content {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px 40px;
      border-radius: 10px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .login-body h4 {
      margin-bottom: 20px;
      font-weight: 600;
    }

    .mb-20 {
      margin-bottom: 20px;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      color: white;
      text-shadow: 1px 1px 2px #000;
    }

    .btn-info.submit {
      width: 100%;
    }

    a.reset_pass {
      display: block;
      margin-top: 10px;
      text-align: right;
      font-size: 0.9em;
    }

    .change_link a {
      font-weight: bold;
    }

    .alert-warning {
      margin-top: 15px;
    }
    .submit-btn {
  background-color: #073f5f;     
  color: white;                  
  padding: 10px 20px;            
  font-size: 16px;
  font-weight: 600;
  border: none;
  border-radius: 6px;
  width: 100%;                   
  transition: background-color 0.3s ease;
}

.submit-btn:hover {
  background-color: #0056b3;     
  cursor: pointer;
}

  </style>
</head>
<body>

<div class="login">
  <div class="reg-header text-center">
    <h1>Library Management System</h1><br><br>
  </div>
  <div class="login-content">
    <div class="login-body">
      <h4 class="text-center">Teacher Login Form</h4>
      <form action="" method="post">
        <div class="mb-20">
          <input type="text" name="username" class="form-control" placeholder="Username" required />
        </div>
        <div class="mb-20">
          <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>
        <div class="mb-20">
          <input class="btn submit-btn" type="submit" name="login" value="Login">
          <a class="reset_pass" href="changepass.php">Lost your password?</a>
        </div>
      </form>
      <?php
      if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Fetch user from DB
    $stmt = mysqli_prepare($link, "SELECT * FROM t_registration WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verify password
        if (password_verify($password, $row["password"])) {
            $_SESSION["teacher"] = $username;
            echo '<script type="text/javascript">window.location="my-issued-books.php";</script>';
        } else {
            echo '<div class="alert alert-warning"><strong>Invalid!</strong> Username or Password.</div>';
        }
    } else {
        echo '<div class="alert alert-warning"><strong>Invalid!</strong> Username or Password.</div>';
    }
}

      ?>
    </div>
    <div class="login-footer text-center mt-3">
      <p class="change_link">New to site? <a href="registration.php">Create Account</a></p>
    </div>
  </div>
  <div class="footer mt-4">
    <p>&copy; All rights reserved school library</p>
  </div>
</div>

<script src="inc/js/jquery-2.2.4.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/custom.js"></script>
</body>
</html>
