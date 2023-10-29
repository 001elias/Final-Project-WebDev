<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in; you can set a variable for easy access on this page
    $loggedIn = true;
} else {
    // User is not logged in
    $loggedIn = false;
}

// Optionally, you can store other user data in variables
if ($loggedIn) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
}
?>
