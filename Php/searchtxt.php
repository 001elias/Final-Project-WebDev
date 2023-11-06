<?php
include('session.php'); // Include the common header
require 'connectDb.php';

$searchTitle = "";
$txtSearch = "";
$noDataFound = "";
$filterBy = "";

$sqlCat = "SELECT * FROM category";
$queryCat = $db->query($sqlCat);
$rowCat = $queryCat->fetchAll(PDO::FETCH_KEY_PAIR);

$sql = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $searchTitle = $_POST['searchTitle'];
  $txtSearch = $_POST['txtSearch'];

  if ($searchTitle == 3) {
    $sql .= " order by b.title asc";
  } else if ($searchTitle == 4) {
    $sql .= " order by b.title desc";
  } else if ($searchTitle == 5) {
    $sql .= " order by b.unitPrice asc";
  } else if ($searchTitle == 6) {
    $sql .= " order by b.unitPrice desc";
  } else if ($searchTitle == 7) {
    $sql .= " order by b.catId, b.unitPrice asc";
  } else if ($searchTitle == 8) {
    $sql .= " order by b.catId, b.unitPrice desc";
  } else {

  }
  $query = $db->query($sql);
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Final-Project-WebDev/Css/style.css">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Bookstore Website</title>
  <style>
    /* Center the book title and ISBN */
    th {
      text-align: center;
      margin-right: 20px;
    }
  </style>
</head>
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



<div class="container">

  <form class="search" action="searchtxt.php" method="post">


    <div class="form-group">
      <label for="searchTitle" class="control-label">Search By:</label>
      <select id="searchTitle" name="searchTitle" required="required" class="select form-control">
        <option value="9">All</option>
        <option value="1">ISBN of Book</option>

        <option value="2"> Title of Book</option>
        <option value="3"> A-Z (Ascending Order)</option>
        <option value="4"> Z-A (Descending Order)</option>
        <option value="5"> Lower to Higher (Price)</option>
        <option value="6"> Higher to Lower (Price))</option>
        <option value="7"> Category with (Price Ascending))</option>
        <option value="8"> Category with (Price Descending))</option>


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
          <th>Book ID </th>
          <th>ISBN </th>
          <th>Title</th>
          <th>Image </th>
          <th></th>
          <th>Category</th>
          <th>Author</th>
          <th>Stock Unit</th>
          <th>Unit Price</th>
        </tr>
        <?php while ($rowBook = $query->fetch()) {
          $link = "singleBook.php?item=" .
            $rowBook['bookId'];

          if ($searchTitle == 1) {
            if ($rowBook['isbn'] == (int) $txtSearch) { ?>
              <div class="col-md-6 portfolio-item">

                <tr style="text-align:center;">
                  <td>
                    <?= $rowBook['bookId']; ?>
                  </td>




                  <td><span class="small">
                      <?= $rowBook['isbn']; ?>
                  </td>
                  <td><a href="<?= $link; ?>">
                      <?= $rowBook['title']; ?>
                  </td>
                  <td>
                    <?php if ($rowBook['image'] != "") { ?>
                      <!-- check if image exists (else dummy photo ?) -->
                      <a href="">
                        <img class="img-responsive" src="<?= $rowBook['image']; ?>" alt width="100" height="150">
                      </a>
                    <?php } else {
                      echo "-";
                    } //end if ?>
                  </td>
                  <td>
                    <?php if ($rowBook['description'] == "") {
                      echo "-";
                    } else {
                      echo $rowBook['description'];
                    }
                    ?>
                  </td>
                  <td>
                    <?php $id = $rowBook['catId'];
                    echo $rowCat[$id];
                    ?>
                  </td>
                  <td>
                    <?= $rowBook['authorName']; ?>
                  </td>
                  <td>
                    <?= $rowBook['stockUnit']; ?>
                  </td>
                  <td>
                    <?= $rowBook['unitPrice']; ?>
                  </td>

                </tr>

              </div>
              <?php
            } else {
              $noDataFound = "ISDN not found";

            }


          } else if ($searchTitle == 2) {

            $lentext = strlen($txtSearch);

            if (substr(strtoLower($rowBook['title']), 0, $lentext) == strtoLower($txtSearch)) { ?>
                <div class="col-md-6 portfolio-item">

                  <tr style="text-align:center;">
                    <td>
                    <?= $rowBook['bookId']; ?>
                    </td>

                    <td><span class="small">
                      <?= $rowBook['isbn']; ?>
                    </td>
                    <td><a href="<?= $link; ?>">
                      <?= $rowBook['title']; ?>
                    </td>
                    <td>
                    <?php if ($rowBook['image'] != "") { ?>
                        <!-- check if image exists (else dummy photo ?) -->
                        <a href="">
                          <img class="img-responsive" src="<?= $rowBook['image']; ?>" alt width="100" height="150">
                        </a>
                    <?php } else {
                      echo "-";
                    } //end if ?>
                    </td>
                    <td>
                    <?php if ($rowBook['description'] == "") {
                      echo "-";
                    } else {
                      echo $rowBook['description'];
                    }
                    ?>
                    </td>
                    <td>
                    <?php $id = $rowBook['catId'];
                    echo $rowCat[$id];
                    ?>
                    </td>
                    <td>
                    <?= $rowBook['authorName']; ?>
                    </td>
                    <td>
                    <?= $rowBook['stockUnit']; ?>
                    </td>
                    <td>
                    <?= $rowBook['unitPrice']; ?>
                    </td>

                  </tr>

                </div>
              <?php
            } else {
              $noDataFound = "Book Title named not found";

            }


          } else { ?>
              <div class="col-md-6 portfolio-item">
                <tr style="text-align:center;">
                  <td>
                  <?= $rowBook['bookId']; ?>
                  </td>
                  <td><span class="small">
                    <?= $rowBook['isbn']; ?>
                  </td>
                  <td><a href="<?= $link; ?>">
                    <?= $rowBook['title']; ?>
                  </td>
                  <td>
                  <?php if ($rowBook['image'] != "") { ?>
                      <!-- check if image exists (else dummy photo ?) -->
                      <a href="">
                        <img class="img-responsive" src="<?= $rowBook['image']; ?>" alt width="100" height="150">
                      </a>
                  <?php } else {
                    echo "-";
                  } //end if ?>
                  </td>
                  <td>
                  <?php if ($rowBook['description'] == "") {
                    echo "-";
                  } else {
                    echo $rowBook['description'];
                  }
                  ?>
                  </td>
                  <td>
                  <?php $id = $rowBook['catId'];
                  echo $rowCat[$id];
                  ?>
                  </td>
                  <td>
                  <?= $rowBook['authorName']; ?>
                  </td>
                  <td>
                  <?= $rowBook['stockUnit']; ?>
                  </td>
                  <td>
                  <?= $rowBook['unitPrice']; ?>
                  </td>

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