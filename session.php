<<<<<<< HEAD
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
=======
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
>>>>>>> bf238caf763260a51f9b6b315717770539c9a819
?>