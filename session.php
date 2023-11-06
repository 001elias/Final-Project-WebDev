<?php
// Start the session
session_start();

// Initialize $loggedIn to false
$loggedIn = false;

// Check if the user is logged in
if (isset($_SESSION['user']) && $_SESSION['user'] === true && isset($_SESSION['customerId'])) {
    // User is logged in
    $loggedIn = true;
    $customerId = $_SESSION['customerId'];
} else {
    $loggedIn = false;
}
?>