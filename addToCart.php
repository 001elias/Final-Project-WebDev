<?php
session_start();
require 'connectDb.php';
include('session.php');

$loggedIn = isset($_SESSION['user']);

if (!$loggedIn) {
    // Handle cases when the user is not logged in.
    // You may redirect them to the login page or display a message.
    exit("Please log in to add items to your cart.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['bookId']; // The book ID from the form.
    $customerId = $_SESSION['customerId'];
    $quantity = $_POST['quantity']; // The quantity from the form.

    // You can add validation for the book ID and quantity here if needed.

    // Check if the book is already in the cart for this user.
    $stmt = $db->prepare("SELECT * FROM cart WHERE customerId = ? AND bookId = ?");
    $stmt->execute([$customerId, $bookId]);
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // If the book is already in the cart, update the quantity.
        $newQuantity = $existingItem['quantity'] + $quantity;
        $stmt = $db->prepare("UPDATE cart SET quantity = ? WHERE customerId = ? AND bookId = ?");
        $stmt->execute([$newQuantity, $customerId, $bookId]);
    } else {
        // If it's not in the cart, insert a new item.
        $stmt = $db->prepare("INSERT INTO cart (customerId, bookId, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$customerId, $bookId, $quantity]);
    }


    // Redirect back to the books page or wherever you want to go.
    header("Location: books.php");
    exit();
} else {
    echo "Invalid request.";
}
?>