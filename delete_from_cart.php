<?php
require 'connectDb.php';
include('session.php'); // Include the common header
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bookId'])) {
        $bookId = $_POST['bookId'];
        $customerId = $_SESSION['customerId'];

        // Remove the item from the cart in the database
        $stmt = $db->prepare("DELETE FROM cart WHERE bookId = ? AND customerId = ?");
        $stmt->execute([$bookId, $customerId]);

        if ($stmt->rowCount() > 0) {
            echo "success"; // Send a success response
        }
    }
}
