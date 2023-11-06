<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
include('session.php'); // Include the common header
$loggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .admin a {
            color: red;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Final-Project-WebDev/Css/style.css">
    <link rel="stylesheet" href="/Final-Project-WebDev/Css/aboutUs.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .admin a {
            color: red;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 2px 0;
        }

        .header .logo img {
            height: 60px;
            width: auto;
        }

        .header .header-title {
            font-family: 'Pacifico', cursive;
            font-size: 24px;
        }

        .header .navigation {
            display: flex;
            align-items: center;
        }

        .header .menu {
            list-style: none;
            padding: 0;
            display: flex;
        }

        .header .menu li {
            margin: 0 15px;
        }

        .admin-dashboard {
            padding: 40px 0;
        }

        .card {
            border: none;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>

                <div class="col-md-2">
                    <div class="navigation">
                        <ul class="menu">
                            <li class="admin"><a href="admin_dashboard.php">Admin Dashboard</a></li>
                            <li><a href="admin_logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container admin-dashboard">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer Records</h5>
                        <p class="card-text">Access customer records.</p>
                        <a href="customerList.php" class="btn btn-primary">Go to Customer Records</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book Records</h5>
                        <p class="card-text">Access book records.</p>
                        <a href="stockAdmin.php" class="btn btn-primary">Go to Book Records</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>