<?php
include('session.php'); // Include the common header
$loggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/Final-Project-WebDev/Css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
  <header class="header">
    <div class="logo">
      <a href="#"><img src="/Final-Project-WebDev/Assets/logo1.png" alt="Bookish Logo"></a>
    </div>
    <div class="header-title">Bookish Bookstore</div>
    <div class="navigation">
      <input type="checkbox" class="toggle-menu" />
      <div class="hamburger"></div>
      <ul class="menu">
        <li><a href="home.php">Home</a></li>
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
          <li><a href="cart.php"><img src="/Final-Project-WebDev/Assets/cart-icon.jpg" style="width:50px;height:60px;"
                alt="Cart"></a></li>
        <?php endif; ?>

      </ul>
    </div>
  </header>


  <section class="best-selling-books">
    <h2 class="carousel-title">Featured Books</h2>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="/Final-Project-WebDev/Assets/agatha (1).jpg">
        </div>

        <div class="item">
          <img src="/Final-Project-WebDev/Assets/lord (1).jpg">
        </div>

        <div class="item">
          <img src="/Final-Project-WebDev/Assets/midnight (1).jpg">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <div class="footer_container">
    <div class="footer_left">
      <h3>Bookish Bookstore</h3>
      <p>
        We love reading and sharing our passion for books. Find your next
        favorite book here!
      </p>
    </div>
    <div class="footer_center">
      <h3>Contact Us</h3>
      <p>Email: info@bookish.com</p>
      <p>Phone: 555-123-4567</p>
    </div>
    <div class="footer_right">
      <h3>Follow Us</h3>
      <div class="social">
        <a href="#"><i class="ri-facebook-fill"></i></a>
        <a href="#"><i class="ri-twitter-fill"></i></a>
        <a href="#"><i class="ri-instagram-fill"></i></a>
      </div>
    </div>
  </div>
  <input type="hidden" id="hiddencontainer" name="hiddencontainer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    const carousel = document.querySelector('.carousel');

    radioButtons.forEach((radio, index) => {
      radio.addEventListener('change', () => {
        carousel.style.transform = `translateX(calc((var(--position) - ${index}) * -100%))`;
        carousel.style.setProperty('--position', index);
      });
    });
  </script>
</body>

</html>