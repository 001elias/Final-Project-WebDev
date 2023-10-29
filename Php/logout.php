<?php
session_start();

// Destroy the session
session_destroy();

$_SESSION = array();

// Redirect to the login page
header("Location: login.php");
exit;
?>

