<?php
    session_start(); // Start the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect the user to the login page or any other page as needed
    header("Location: ../../ad_login.php");
    exit(); // Ensure that no code is executed after the redirect
?>