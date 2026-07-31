<?php 
    include 'inc/connection.php';
?>
<?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $sem = $_POST["sem"];
        $dept = $_POST["dept"];
        $session = $_POST["session"];
        $regno = $_POST["regno"];
        $address = $_POST["address"];
        $photo = "upload/avatar.jpg";
        $utype = "student";

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($name == "" || $username == "" || $password == "" || $email == "" || $phone == "" || $sem == "" || $dept == "" || $session == "" || $regno == "" || $address == "") {
            $error_m = "<b>Error !</b> <span>Field mustn't be empty</span>";
        }

        $sql_u = mysqli_query($link, "SELECT * FROM std_registration WHERE username = '$username'");
        $sql_e = mysqli_query($link, "SELECT * FROM std_registration WHERE email = '$email'");
        $sql_p = mysqli_query($link, "SELECT * FROM std_registration WHERE phone = '$phone'");
        $sql_r = mysqli_query($link, "SELECT * FROM std_registration WHERE regno = '$regno'");

        $sql2_u = mysqli_query($link, "SELECT * FROM t_registration WHERE username = '$username'");
        $sql2_e = mysqli_query($link, "SELECT * FROM t_registration WHERE email = '$email'");
        $sql2_p = mysqli_query($link, "SELECT * FROM t_registration WHERE phone = '$phone'");

        if (mysqli_num_rows($sql_u) > 0 || mysqli_num_rows($sql2_u) > 0) {
            $error_uname = "Username already exists";
        } elseif (mysqli_num_rows($sql_e) > 0 || mysqli_num_rows($sql2_e) > 0) {
            $error_email = "Email already exists";
        } elseif (mysqli_num_rows($sql_p) > 0 || mysqli_num_rows($sql2_p) > 0) {
            $error_phone = "Phone already registered";
        } elseif (mysqli_num_rows($sql_r) > 0) {
            $error_reg = "This regno already registered";
        } elseif (strlen($username) < 6) {
            $error_ua = "<b>Username too short !</b> <span>Your username must be 6-16 characters</span>";
        } elseif (strlen($username) > 16) {
            $error_ua = "<b>Username too long !</b> <span>Your username must be 6-16 characters</span>";
        } elseif (strlen($password) < 6) {
            $error_pw = "<b>Password too short !</b> <span>Your password must be 6-16 characters</span>";
        } elseif (strlen($password) > 16) {
            $error_pw = "<b>Password too long !</b> <span>Your password must be 6-16 characters</span>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $e_msg = "<strong>Error ! </strong> <span>Email Address Not Valid</span>";
        } else {
            $insert = mysqli_query($link, "INSERT INTO std_registration (name, username, password, email, phone, sem, dept, session, regno, address, utype, photo, status) VALUES ('$name', '$username', '$hashed_password', '$email', '$phone', '$sem', '$dept', '$session', '$regno', '$address', '$utype', '$photo', 'active')");

            if ($insert) {
                header('Location: dashboard.php');
            } else {
                echo mysqli_error($link);
            }
        }
    }
?>
