<?php
session_start();

require 'connectDb.php'; // Include your database connection script

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customerId = $db->lastInsertId();
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }

    if ($password !== $passwordRepeat) {
        array_push($errors, "Password does not match");
    }

    // Check if email already exists in the database
    $sql = "SELECT * FROM customer WHERE cusEmail = :email";
    $query = $db->prepare($sql);
    $query->execute(["email" => $email]);
    $data = $query->fetch();

    if ($data) {
        array_push($errors, "Email already exists!");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Split the full name into first name and last name
        list($firstName, $lastName) = explode(' ', $fullName);

        // Insert user data into the 'customer' table in the 'fsd10_yankee' database
        $sql = "INSERT INTO customer (cusFirstName, cusLastName, cusEmail, cusPassword) VALUES (?, ?, ?, ?)";
        $query = $db->prepare($sql);
        $query->execute([$firstName, $lastName, $email, $passwordHash]);

        echo "<div class='alert alert-success'>You are registered successfully. You can now login.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/style.css">
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
                    <li><a href="cart.php"><img src="Assets/cart-icon.jpg" style="width:50px;height:60px;" alt="Cart"></a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </header>
    <div class="container">
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        </div>
    </div>
</body>

</html>