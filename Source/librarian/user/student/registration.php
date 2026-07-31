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
            margin-bottom: 10px;
            font-weight: 600;
        }

        .reg-header h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 500;
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
            <h2>Student Registration Form</h2>
        </div>

        <form action="" method="post">
            <?php if(isset($s_msg)) echo '<span class="success">'.$s_msg.'</span>'; ?>
            <?php if(isset($error_m)) echo '<span class="error">'.$error_m.'</span>'; ?>

            <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control custom" name="name" placeholder="Your Name">
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
                <label>Semester *</label>
                <select class="form-control custom" name="sem">
                    <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                    <option>5th</option>
                    <option>6th</option>
                    <option>7th</option>
                    <option>8th</option>
                </select>
            </div>

            <div class="form-group">
                <label>Department *</label>
                <select class="form-control custom" name="dept">
                    <option>CSE</option>
                    <option>EEE</option>
                    <option>ECE</option>
                    <option>BBA</option>
                    <option>Others</option>
                </select>
            </div>

            <div class="form-group">
                <label>Session *</label>
                <input type="text" class="form-control custom" name="session" placeholder="e.g. 14/15">
            </div>

            <div class="form-group">
                <label>Registration No *</label>
                <input type="text" class="form-control custom" name="regno" placeholder="Registration Number">
                <?php if(isset($error_reg)) echo '<span class="error">'.$error_reg.'</span>'; ?>
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
