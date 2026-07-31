<?php

function logActivity($link, $action, $description)
{
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

        // Default role
        $role = "User";

        // Optional role session
        if(isset($_SESSION['role']))
        {
            $role = $_SESSION['role'];
        }

        $ip = $_SERVER['REMOTE_ADDR'];

        mysqli_query($link,"
        INSERT INTO activity_logs
        (username, role, action, description, ip_address)
        VALUES
        ('$username','$role','$action','$description','$ip')
        ");
    }
}

?>
