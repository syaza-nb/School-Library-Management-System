<?php 
    include 'inc/connection.php';
    include 'inc/function.php';
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
            background: url('inc/img/login-background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .registration-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 15px;
        }

        .reg-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .reg-header h2 {
            text-align: center;
            color: #073f5f;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group label {
            font-weight: 500;
        }

        .form-control.custom {
            margin-bottom: 20px;
        }

        .submit input[type="submit"] {
            background-color: #073f5f;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            width: 100%;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }

        .submit input[type="submit"]:hover {
            background-color: #0056b3;
            cursor: pointer;
        }

        .error, .errort, .success {
            display: block;
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .success {
            color: green;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: white;
            text-shadow: 1px 1px 2px #000;
        }

        @media (max-width: 768px) {
            .reg-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="registration-wrapper">
    <div class="reg-card">
        <div class="reg-header">
            <h2>Teacher Registration</h2>
        </div>
        <form action="" method="post">
            <?php if(isset($s_msg)):?><span class="success"><?php echo $s_msg; ?></span><?php endif ?>
            <?php if(isset($error_m)):?><span class="errort"><?php echo $error_m; ?></span><?php endif ?>

            <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control custom" name="name" placeholder="Full Name">
            </div>

            <div class="form-group">
                <label>Username *</label>
                <input type="text" class="form-control custom" name="username" placeholder="Username">
                <?php if(isset($error_ua)) echo '<span class="error">'.$error_ua.'</span>'; ?>
                <?php if(isset($error_uname)) echo '<span class="error">'.$error_uname.'</span>'; ?>
            </div>

            <div class="form-group">
                <label>Password *</label>
                <input type="password" class="form-control custom" name="password" placeholder="Password">
                <?php if(isset($error_pw)) echo '<span class="error">'.$error_pw.'</span>'; ?>
            </div>

            <div class="form-group">
                <label>Lecturer / Department *</label>
                <input type="text" class="form-control custom" name="lecturer" placeholder="Lecturer / Department">
            </div>

            <div class="form-group">
                <label>Email *</label>
                <input type="text" class="form-control custom" name="email" placeholder="Email">
                <?php if(isset($e_msg)) echo '<span class="error">'.$e_msg.'</span>'; ?>
                <?php if(isset($error_email)) echo '<span class="error">'.$error_email.'</span>'; ?>
            </div>

            <div class="form-group">
                <label>Phone Number *</label>
                <input type="text" class="form-control custom" name="phone" placeholder="Phone Number">
                <?php if(isset($error_phone)) echo '<span class="error">'.$error_phone.'</span>'; ?>
            </div>

            <div class="form-group">
                <label>ID Number *</label>
                <input type="text" class="form-control custom" name="idno" placeholder="ID Number">
                <?php if(isset($error_id)) echo '<span class="error">'.$error_id.'</span>'; ?>
            </div>

            <div class="form-group">
                <label>Address *</label>
                <textarea name="address" class="form-control custom" rows="3" placeholder="Your Address"></textarea>
            </div>

            <div class="submit">
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
</div>

<div class="footer">
    <p>&copy; All rights reserved school library</p>
</div>

<script src="inc/js/jquery-2.2.4.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/custom.js"></script>
</body>
</html>
