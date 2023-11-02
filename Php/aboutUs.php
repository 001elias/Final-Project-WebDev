<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
include('session.php'); // Include the common header
$loggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Final-Project-WebDev/Css/style.css">
    <link rel="stylesheet" href="/Final-Project-WebDev/Css/aboutUs.css">

    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <link
      href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Bookstore Website</title>
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
          <?php if ($loggedIn != 1): ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Register</a></li>
          <?php endif; ?>
            
          <?php if ($loggedIn == 1): ?>
            <li><a href="logout.php">Logout</a> </li>
            <li><a href="cart.php"><img src="/Final-Project-WebDev/Assets/cart-icon.jpg" style="width:50px;height:60px;" alt="Cart"></a></li>
          <?php endif; ?>
          
        </ul>
      </div>
    </header>
    <main>
        <section class="about">
            <h2>About</h2>
            <p>"At Read & Revel, we bridge the timeless allure of traditional books with the convenience of modern technology. As a premier online bookstore, we pride ourselves on curating an expansive selection that caters to the diverse tastes of book lovers worldwide. From classic literature to contemporary bestsellers, our digital shelves are stocked with titles that promise to enlighten, entertain, and inspire. We understand the magic that a book holds within its pages, and with our user-friendly platform, we aim to make your book-buying experience as enchanting as the tales you choose. Committed to fostering a global community of readers, Read & Revel ensures that no matter where you are, your next favorite book is just a click away."</p>
            <h3>Founded: 2023</h3>

            <div class="team">
                <div class="team-member">
                    <img src="/Final-Project-WebDev/Assets/Ayman1.jpg" alt="Ayman Zriek">
                    <h4>Ayman Zriek</h4>
                    <p>John Doe is an experienced entrepreneur with a passion for innovation. He has successfully launched several startups and is committed to driving the company towards success.</p>
                </div>
                <div class="team-member">
                    <img src="/Final-Project-WebDev/FrontEnd/Elias1.png" alt="Elias Barrellet">
                    <h4>Elias Barrellet</h4>
                    <p>Jane Smith is a finance expert with a strong background in financial management. Her strategic insights and expertise have played a crucial role in the company's growth and profitability.</p>
                </div>
                <div class="team-member">
                    <img src="/Final-Project-WebDev/FrontEnd/Ashok1.png" alt="Ashok Chand">
                    <h4>Ashok Chand</h4>
                    <p>Jane Smith is a finance expert with a strong background in financial management. Her strategic insights and expertise have played a crucial role in the company's growth and profitability.</p>
                </div>
            </div>
        </section>
        <section class="mission-vision-awards">
            <h2>MISSION</h2>
            <p>Our mission is to provide our customers with the best possible products and services, ensuring their satisfaction and loyalty.</p>
            <h2>VISION</h2>
            <p>We envision a future where our company becomes a global leader in our industry, known for our exceptional quality and customer-centric approach.</p>
            <h2>AWARDS</h2>
            <p>We are proud to have been recognized with numerous industry accolades and awards, which reflect our dedication to excellence and innovation.</p>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

