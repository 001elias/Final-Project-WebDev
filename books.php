<?php
require 'connectDb.php';

include('session.php'); // Include the common header
$loggedIn = isset($_SESSION['user']);

$sql = "SELECT b.*, a.*, c.quantity
        FROM book b
        JOIN book_author ba ON b.bookId = ba.bookId
        JOIN author a ON ba.authorId = a.authorId
        LEFT JOIN cart c ON b.bookId = c.bookId"; // Assuming cart has a 'quantity' column

$query = $db->query($sql);

/* 
$sqlCat  = "SELECT * FROM category";
$queryCat= $db->query($sqlCat);

$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);
print_r($rowCat);
print_r($rowCat['12']); */

$sqlCat = "SELECT * FROM category";
$queryCat = $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Css/style.css">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Center the book title and ISBN */
    .portfolio-item h3 {
      text-align: center;
      margin-top: 15px;
      /* Adjust the margin as needed */
    }

    /* Center the image */
    .portfolio-item img {
      display: block;
      margin: 0 auto;
    }

    /* Center the category and price */
    .portfolio-item p {
      text-align: center;
      margin-top: 10px;
      /* Adjust the margin as needed */
    }

    /* Center the "Add to Cart" button */
    .add-to-cart-form {
      text-align: center;
    }

    .title {
      text-align: center;
    }

    p {
      font-size: 18px;
    }
  </style>

</head>

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

<div class="row">
  <h1 class=title>Our Books</h1>
  <?php while ($rowBook = $query->fetch()): ?>
    <div class="col-md-6 portfolio-item">
      <?php if ($rowBook['image'] != ""): ?>
        <a href="">
          <img class="img-responsive" src="<?= $rowBook['image']; ?>" alt width="200" height="250">
        </a>
      <?php endif; ?>
      <h3>
        <a href="singleBook.php?item=<?= $rowBook['bookId']; ?>">
          <?= $rowBook['title']; ?>
        </a><br>
        <span class="small">ISBN:
          <?= $rowBook['isbn']; ?>
        </span>
      </h3>
      <p>
        <?= $rowCat[$rowBook['catId']]; ?>
      </p>
      <p>

        <?= $rowBook['unitPrice']; ?>
        <span class="small">$
      </p>

      <!-- Conditionally display the Add to Cart form when logged in -->
      <?php if ($loggedIn == 1): ?>
        <form class="add-to-cart-form" method="POST" action="addToCart.php">
          <input type="hidden" name="bookId" value="<?= $rowBook['bookId']; ?>">
          <label for="quantity">Quantity:</label>
          <input type="number" name="quantity" value="1" min="1" max="<?= $rowBook['stockUnit']; ?>">
          <button type="submit">Add to Cart</button>
        </form>
      <?php endif; ?>
    </div>

  <?php endwhile; ?>
</div>


<!-- Cart Confirmation Message -->
<div class="cart-message" style="display: none;"></div>

<script>
  function addToCart(bookId, quantity) {
    $.ajax({
      type: 'POST',
      url: 'addToCart.php',
      data: { bookId: bookId, quantity: quantity },
      success: function (response) {
        if (response === 'success') {
          alert(`${quantity} book(s) added to cart successfully.`);
        }
      }
    });
  }

  // JavaScript to handle the form submission
  const addToCartForms = document.querySelectorAll('.add-to-cart-form');

  addToCartForms.forEach((form) => {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      const bookId = this.querySelector('[name="bookId"]').value;
      const quantity = this.querySelector('[name="quantity"]').value;

      // You can add additional logic here, e.g., check if the quantity is valid
      // and other custom checks

      // Display a success message
      const successMessage = document.createElement('p');
      successMessage.textContent = `${quantity} book(s) added to cart.`;
      successMessage.style.color = 'green';
      this.appendChild(successMessage);

      // You can also add the book and quantity to your cart in JavaScript
      // using the `addToCart` function you defined earlier
      addToCart(bookId, quantity);
    });
  });
</script>



<?php


?>