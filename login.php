<?php
include('session.php'); // Include the common header
require 'connectDb.php'; // Include your database connection script

if (isset($_SESSION['user'])) {
    header("location: index.php");
    die();
}

function validateIsEmptyData($data, $field)
{
    if (empty($data[$field])) {
        return true; // Field is empty
    }
    return false; // Field is not empty
}

$errorMessages = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (validateIsEmptyData($_POST, 'email')) {
        $errorMessages .= "Email is required <br>";
    }

    if (validateIsEmptyData($_POST, 'password')) {
        $errorMessages .= "Password is required <br>";
    }

    if ($errorMessages == "") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Attempt to fetch data from the 'customer' table
        $sql = "SELECT * FROM customer WHERE cusEmail = :email";
        $query = $db->prepare($sql);
        $query->execute(["email" => $email]);
        $data = $query->fetch();

        if ($data && password_verify($password, $data['cusPassword'])) {
            // User login is successful
            $_SESSION['user'] = true;
            $_SESSION['realName'] = $data['cusFirstName'] . ' ' . $data['cusLastName'];
            $_SESSION['customerId'] = $data['customerId'];
            header("location: index.php");
            exit; // Important to stop further execution
        } else {
            // If it's not a normal user, check if it's an admin
            $sql = "SELECT * FROM tbladmin WHERE adminEmail = :email";
            $query = $db->prepare($sql);
            $query->execute(["email" => $email]);
            $adminData = $query->fetch();

            if ($adminData && password_verify($password, $adminData['adminPass'])) {
                // Admin login is successful
                $_SESSION['admin'] = true;
                header("location: admin_dashboard.php"); // Redirect to admin dashboard
                exit; // Important to stop further execution
            } else {
                $errorMessages = "Invalid Email or Password";
            }
        }
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
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
    </style>
    <!-- End of styles and fonts -->
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
        <?php if (!empty($errorMessages)): ?>
            <div class="alert alert-danger">
                <?php echo $errorMessages; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>