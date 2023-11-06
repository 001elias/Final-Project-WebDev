<?php
session_start(); // Start the session

// Check if the admin is logged in
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit;
} else {
    // If the admin is not logged in, you can redirect to a login page or any other appropriate page
    header("Location: login.php");
    exit;
}
?>