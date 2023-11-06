<?php
session_start(); // Start the session

require 'connectDb.php';

$confirmationMessage = ""; // Initialize the confirmation message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['address']) && isset($_POST['card'])) {
        // Get the user input from the form
        $name = $_POST['name'];
        $cusPhone = $_POST['number'];
        $cusAddress = $_POST['address'];
        $card = $_POST['card'];

        // Insert the customer's phone number and address into the customer table
        $customerId = $_SESSION['customerId']; // Assuming you have a customer ID in the session
        $sql = "UPDATE customer SET cusPhone = ?, cusAddress = ? WHERE customerId = ?";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            if ($stmt->execute([$cusPhone, $cusAddress, $customerId])) {
                // Insert order details into an orders table if needed
                // Add code for order insertion here

                // Set the confirmation message
                $confirmationMessage = "Thank you for your order!";
            } else {
                $confirmationMessage = "An error occurred while updating customer information.";
            }
        } else {
            $confirmationMessage = "Database error: " . $db->errorInfo()[2];
        }
    } else {
        $confirmationMessage = "Invalid form data. Please fill out all fields.";
    }
} else {
    $confirmationMessage = "Invalid request. Please use the checkout form to place an order.";
}

echo $confirmationMessage;
?>