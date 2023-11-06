<?php
require 'connectDb.php';
include('session.php'); // Include the common header

$searchBy = "";
$searchTitle = "";
$txtSearch = "";

$sqlCat = "SELECT * FROM category";
$queryCat = $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);

$sql = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
$query = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $searchBy = $_POST['searchBy'];


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

  <form class="search" action="categories.php" method="post">

    <div class="form-group">
      <label for="searchBy" class="control-label">Category</label>
      <select id="searchBy" name="searchBy" class="select form-control">
        <option value="">-----</option>
        <?php foreach ($rowCat as $cat_id => $cat_name) {
          $selected = ($cat_id == $searchBy) ? "selected" : "";
          ?>
          <option value="<?= $cat_id; ?>" <?= $selected; ?>>
            <?= $cat_name; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-btn">
      <input type="submit" value="search" name="search" class="btn btn-primary">
    </div>
    <div class="row">

      <p>
      <h1>List of Books by category</h1>
      </p>
      <p></p>
      <table>
        <tr>
          <th>Book ID </th>
          <th>ISBN </th>
          <th>Title</th>
          <th>Image </th>
          <th>Description</th>
          <th>Category</th>
          <th>Author</th>
          <th>Stock Unit</th>
          <th>Unit Price</th>
        </tr>
        <?php while ($rowBook = $query->fetch()) {
          $link = "singleBook.php?item=" .
            $rowBook['bookId'];

          if ($searchBy == $rowBook['catId']) { ?>
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
        } // end while  ?>

  </form>
</div>

</div>