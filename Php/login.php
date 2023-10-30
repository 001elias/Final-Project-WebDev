<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    require_once "database.php";
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = "yes";
            header("Location: /Final-Project-WebDev/Php/home.php"); //Redirect to home.php 
            exit();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Include CSS styles and fonts from the home.html page -->
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
    <link href="/Final-Project-WebDev/FrontEnd/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
        }

        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .fixed-header .logo {
            font-family: 'Pacifico', cursive;
            font-size: 24px;
        }

        .fixed-header .menu {
            list-style: none;
            padding: 0;
            display: flex;
        }

        .fixed-header .menu li {
            margin: 0 15px;
        }

        .container {
            margin-top: 60px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        .login-form .form-group {
            margin: 10px 0;
        }

        .login-form .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form .form-btn {
            text-align: center;
        }

        .login-form .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form .btn:hover {
            background-color: #0056b3;
        }
    </style>
    </style>
    <!-- End of styles and fonts -->
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#"><img src="/Final-Project-WebDev/FrontEnd/logo1.png" alt="Bookish Logo"></a>
        </div>
        <div class="header-title">Bookish Bookstore</div>
        <div class="navigation">
            <input type="checkbox" class="toggle-menu" />
            <div class="hamburger"></div>
            <ul class="menu">
                <!-- Include the full navigation menu from home.html -->
                <li><a href="/Final-Project-WebDev/Php/home.php">Home</a></li>
          <li><a href="/Final-Project-WebDev/Php/books.php">Books</a></li>
          <li><a href="/Final-Project-WebDev/FrontEnd/childbooks.html">Child Books</a></li>
          <li><a href="/Final-Project-WebDev/FrontEnd/contactus.html">Contact us</a></li>
          <li><a href="/Final-Project-WebDev/Php/aboutUs.php">About Us</a></li>
          <?php if ($loggedIn != 1): ?>
            <li><a href="/Final-Project-WebDev/Php/login.php">Login</a></li>
            <li><a href="/Final-Project-WebDev/Php/registration.php">Register</a></li>
          <?php endif; ?>
            
          <?php if ($loggedIn == 1): ?>
            <li><a href="/Final-Project-WebDev/Php/logout.php">Logout</a> </li>
            <li><a href="/cart"><img src="/Final-Project-WebDev/FrontEnd/cart-icon.jpg" style="width:50px;height:60px;" alt="Cart"></a></li>
          <?php endif; ?>
                <!-- End of navigation menu -->
            </ul>
        </div>
    </header>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: http://localhost/FrontEnd/home.html?loggedin=1");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>

<form class="login-form" action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>