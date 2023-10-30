<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']) && $_SESSION['user'] === "yes") {
    // User is logged in
    $loggedIn = true;
} else {
    // User is not logged in
    $loggedIn = false;
}
?>
