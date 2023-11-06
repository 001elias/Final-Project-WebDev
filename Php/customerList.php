<?php




require 'connectDb.php';

$searchBy = "";
$searchTitle = "";
$txtSearch = "";
$noDataFound = "";
$lentext = "";

$sqlCus = "SELECT * FROM customer";
$queryCus = $db->query($sqlCus);
//$rowCus = $queryCus->fetchall();

////$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
//$query = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $searchTitle = $_POST['searchTitle'] ?? "";
  $txtSearch = $_POST['txtSearch'] ?? "";

}


?>

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


  <div class="container">

    <form class="search" action="customerList.php" method="post">


      <div class="form-group">
        <label for="searchTitle" class="control-label">Search By:</label>
        <select id="searchTitle" name="searchTitle" required="required" class="select form-control">
          <option value="2">All</option>
          <option value="1">Customer email Id :</option>



        </select>
      </div>
      <div class="form-group">
        <input type="text" placeholder="" name="txtSearch" class="form-control">
      </div>
      <div class="form-btn">
        <input type="submit" value="search" name="search" class="btn btn-primary">
      </div>



      <div class="row">
        <p>
        <h1>List of Books</h1>
        </p>
        <p></p>
        <table>
          <tr>
            <th>Customer ID </th>
            <th>Email Id </th>
            <th>First Name</th>
            <th>Last Name </th>
            <th>Phone No.</th>
            <th>Address </th>
            <th>Customer Password </th>
          </tr>
          <?php while ($rowCus = $queryCus->fetch()) {
            $link = "editCustomer.php?id=" .
              $rowCus['customerId'];

            if ($searchTitle == 1) {
              $lentext = strlen($txtSearch);

              if (substr(strtoLower($rowCus['cusEmail']), 0, $lentext) == strtoLower($txtSearch)) { ?>

                <div class="col-md-6 portfolio-item">

                  <tr style="text-align:center;">
                    <td>
                      <?= $rowCus['customerId']; ?>
                    </td>
                    <td><a href="<?= $link; ?>"><span class="small">
                          <?= $rowCus['cusEmail']; ?>
                    </td>
                    <td>
                      <?= $rowCus['cusFirstName']; ?>
                    </td>
                    <td>
                      <?= $rowCus['cusLastName']; ?>
                    </td>
                    <td>
                      <?= $rowCus['cusPhone']; ?>
                    </td>
                    <td>
                      <?= $rowCus['cusAddress']; ?>
                    </td>
                    <td>
                      <?= $rowCus['cusPassword']; ?>
                    </td>
                    <td><a href="reset.php?id=<?= $rowCus['customerId']; ?>">Reset Password</a></td>
                    <td><a href="deleteCus.php?id=<?= $rowCus['customerId']; ?>">Delete</a></td>
                  </tr>

                </div>
                <?php
              } else {
                $noDataFound = "User Email Id not found";

              }


            } else {


              ?>
              <div class="col-md-6 portfolio-item">

                <tr style="text-align:center;">
                  <td>
                    <?= $rowCus['customerId']; ?>
                  </td>
                  <td><a href="<?= $link; ?>"><span class="small">
                        <?= $rowCus['cusEmail']; ?>
                  </td>
                  <td>
                    <?= $rowCus['cusFirstName']; ?>
                  </td>
                  <td>
                    <?= $rowCus['cusLastName']; ?>
                  </td>
                  <td>
                    <?= $rowCus['cusPhone']; ?>
                  </td>
                  <td>
                    <?= $rowCus['cusAddress']; ?>
                  </td>
                  <td>
                    <?= $rowCus['cusPassword']; ?>
                  </td>
                  <td><a href="reset.php?id=<?= $rowCus['customerId']; ?>">Reset Password</a></td>
                  <td><a href="deleteCus.php?id=<?= $rowCus['customerId']; ?>">Delete</a></td>
                </tr>

              </div>
              <?php



            }


          }


          if ($noDataFound != "" && $_POST['txtSearch'] != null) {
            echo $noDataFound;
          }
          //end while 
          
          ?>


    </form>
  </div>

  </div>