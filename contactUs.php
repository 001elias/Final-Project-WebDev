<?php
session_start();
include('session.php'); // Include the common header
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if any field is empty
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    $message = 'Please fill up all fields.';
  } else {
    // Email validation
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $message = 'Please enter a valid email address.';
    } else {
      // If all fields are filled and the email is valid
      $message = 'Your message has been sent.';
      // Here you can write code to do something with the post data like storing it in a database or sending it to an email address using PHP's mail function
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="stylesheet" href="Css/style.css">
  <link rel="stylesheet" href="Css/contactUs.css" />

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <header class="header">
    <div class="logo">
      <a href="#"><img src="Assets/logo1.png" alt="Bookish Logo"></a>
    </div>
    <div class="header-title">Bookish Bookstore</div>
    <div class="navigation">
      <input type="checkbox" class="toggle-menu" />
      <div class="hamburger"></div>
      <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="books.php">Books</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="contactUs.php">Contact us</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="searchtxt.php">Search</a></li>
        <?php if ($loggedIn != 1): ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="registration.php">Register</a></li>
        <?php endif; ?>

        <?php if ($loggedIn == 1): ?>
          <li><a href="logout.php">Logout</a> </li>
          <li><a href="cart.php"><img src="Assets/cart-icon.jpg" style="width:50px;height:60px;" alt="Cart"></a></li>
        <?php endif; ?>

      </ul>
    </div>
  </header>
  <section class="contact-form">
    <h1>Contact us</h1>
    <div class="container">
      <form action="contactUs.php" method="POST">
        <h2>Send us a message</h2>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-element" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-element" required />
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" name="subject" id="subject" class="form-element" required />
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" class="form-element" required></textarea>
        </div>
        <input type="submit" name="submit" value="Send Mail" />
        <!-- Place for the message -->
        <div class="form-message">
          <?php if (!empty($message))
            echo "<div class=\"success\">$message</div>"; ?>
        </div>
      </form>
    </div>
  </section>

  <script>
    window.history.pushState({}, document.title, "contactUs.php");
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>