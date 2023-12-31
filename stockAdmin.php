<?php




require 'connectDb.php';

$searchBy = "";
$searchTitle = "";
$txtSearch = "";
$noDataFound = "";


if (array_key_exists('item', $_GET)) {
  // ?item=x is in the URL

  // check that the item exists in the DB
  $query = $db->prepare("SELECT * FROM portfolio WHERE portfolio_id = :id");
  $query->execute(['id' => $_GET['item']]);

  $data = $query->fetch();
  if (!$data) { // nothing found in the database
    pageNotFound();
  }
  // populate the form
  $txtTitle = $data['title'];
  $txtBody = $data['body'];
  $txtCaption = $data['caption'];
  $selCategory = $data['category_id'];
  $fileImage = $data['image'];
  $itemId = $data['portfolio_id'];
}
$sqlCat = "SELECT * FROM category";
$queryCat = $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);

$sql = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
$query = $db->query($sql);

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
  <link rel="stylesheet" href="Css/style.css">
  <link rel="stylesheet" href="Css/aboutUs.css">
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

    <form class="search" action="searchtxt.php" method="post">


      <div class="form-group">
        <label for="searchTitle" class="control-label">Search By:</label>
        <select id="searchTitle" name="searchTitle" required="required" class="select form-control">
          <option value="3">All</option>
          <option value="1">ISBN of Book</option>

          <option value="2"> Title of Book</option>

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
            <th>Description</th>
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
                          <img class="img-responsive" src="<?= $rowBook['image']; ?>" width="80" height="100" alt />
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
                    <td><a href="editRecord.php?id=<?= $rowBook['bookId']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?= $rowBook['bookId']; ?>">Delete</a></td>
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
                            <img class="img-responsive" src="<?= $rowBook['image']; ?>" width="80" height="100" alt />
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
                      <td><a href="editRecord.php?id=<?= $rowBook['bookId']; ?>">Edit</a></td>
                      <td><a href="delete.php?id=<?= $rowBook['bookId']; ?>">Delete</a></td>
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
                          <img class="img-responsive" src="<?= $rowBook['image']; ?>" width="80" height="100" alt />
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
                    <td><a href="editRecord.php?id=<?= $rowBook['bookId']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?= $rowBook['bookId']; ?>">Delete</a></td>
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