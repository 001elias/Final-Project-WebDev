<?php
session_start();
require 'connectDb.php';

//print_r($_GET);



$txtBookId = "";
$txtIsbn = "";
$txtTitle = "";
$fileImage = "";
$txtDes = "";
$selCategory = "";
$txtAuthorId = "";
$txtAuthor = "";
$txtStock = "";
$txtPrice = "";
$errorMessages = "";
$qAuthorId = "";


$sqlCat = "SELECT * FROM category";
$queryCat = $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);



<<<<<<< HEAD
if (array_key_exists('id', $_GET)) {
	// ?item=x is in URL while doing edit 
	// CHECK that item is in database
	$sql = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId WHERE b.bookId = :value";
	$query = $db->prepare($sql);
	$query->execute(['value' => $_GET['id']]);

	$qbook = $query->fetch();
	if (!$qbook) { // nothing found in database
		echo "Page Not Found";
	}
	// populate my form
	$txtBookId = $qbook['bookId'];
	$txtIsbn = $qbook['isbn'];
	$txtTitle = $qbook['title'];
	$fileImage = $qbook['image'];
	$txtDes = $qbook['description'];
	$selCategory = $qbook['catId'];
	$qAuthorId = $qbook['authorId'];
	$txtAuthor = $qbook['authorName'];
	$txtStock = $qbook['stockUnit'];
	$txtPrice = $qbook['unitPrice'];
=======
if (array_key_exists('id',$_GET)){
  // ?id=x is in URL while doing edit 
  // CHECK that item is in database
  $sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId WHERE b.bookId = :value";
  $query = $db->prepare($sql);
  $query->execute(['value'=>$_GET['id']]);
>>>>>>> 72792248c7df0e1c1a929bef38895b1af0e12f85

}

$sqlAuthor = "SELECT * FROM author";
$queryAuthor = $db->query($sqlAuthor);
$rowAuthor = $queryAuthor->fetchall();
$lastid = sizeof($rowAuthor);
//print_r($qAuthorId);

<<<<<<< HEAD
if ($_SERVER['REQUEST_METHOD'] == "POST") {
=======
print_r($fileImage);
if ($_SERVER['REQUEST_METHOD'] == "POST"){
>>>>>>> 72792248c7df0e1c1a929bef38895b1af0e12f85
	// form was submitted

	// validating the form
	if (is_null($_POST['txtIsbn']))
		$errorMessages .= "ISBN is required <br>";
	else
		$txtIsbn = $_POST['txtIsbn'];

	if (is_null($_POST['txtTitle']))
		$errorMessages .= "Book Title is required <br>";
	else
		$txtTitle = $_POST['txtTitle'];

	if (is_null($_POST['selCategory']))
		$errorMessages .= "Category is required <br>";
	else
		$selCategory = $_POST['selCategory'];

	if (is_null($_POST['txtAuthor']))
		$errorMessages .= "Author Name is required <br>";
	else
		$txtAuthor = $_POST['txtAuthor'];

	if (is_null($_POST['txtStock']))
		$errorMessages .= "Stock is required <br>";
	else
		$txtStock = $_POST['txtStock'];

	if (is_null($_POST['txtPrice']))
		$errorMessages .= "Unit Price is required <br>";
	else
		$txtPrice = $_POST['txtPrice'];
	$txtDes = $_POST['txtDes'] ?? "";
	$fileImage = $_POST['oldImage'] ?? ""; // tracking existing image during update
	$txtBookId = $_POST['txtBookId'] ?? ""; // track item id if it exists
	$qAuthorId = $_POST['qAuthorId'] ?? "";

	// if error message is empty then save to db
	if ($errorMessages == "") {
		// save and upload the file (if applicable)
		if ($_FILES['fileImage']['error'] == 0) {
			// file is found - save to server
			// TODO: validate extension or type (if needed)
			$sourceFile = $_FILES['fileImage']['tmp_name'];
			$destinationFile = "image/" . $_FILES['fileImage']['name']; //change the reference of folder to save

			if (move_uploaded_file($sourceFile, $destinationFile)) {
				// file has been moved
				// removed any old files
				if ($fileImage != "" && $fileImage != $destinationFile) {
					// file it not an empty string = a file exists
					// AND it's not the same file as the new one just uplpoaded
					unlink($fileImage); //DELETE FROM THE SERVER
				}
				$fileImage = $destinationFile;
			} else {
				// file has NOT been moved
			}

		} // end $FILE error

		//print_r($selCategory);
		// add to my database
		$databook = [
			"isbn" => $txtIsbn,
			"title" => $txtTitle,
			"image" => $fileImage,
			"description" => $txtDes,
			"catId" => $selCategory,
			"stockUnit" => $txtStock,
			"unitPrice" => $txtPrice

		];



		if ($txtBookId == "") {
			// no item id was found = add new row to the database
			$sql = "INSERT INTO book (isbn, title, image, description, catId, stockUnit, unitPrice) VALUES (:isbn, :title, :image, :description, :catId, :stockUnit , :unitPrice);";

			$dataAuth = [
				"authId" => $lastid + 1,
				"authName" => $txtAuthor
			];



			$sqlAuth = "INSERT INTO author (authorId, authorName) VALUES (:authId , :authName);";




		} else {


			// item id was found = update existing row
			$sql = "UPDATE book SET isbn =:isbn, title = :title, image = :image, description = :description, catId = :catId, stockUnit = :stockUnit, unitPrice = :unitPrice WHERE bookId = :pid;";

			$databook["pid"] = $txtBookId;
			$dataAuth = ["authName" => $txtAuthor];
			$dataAuth["authpid"] = $qAuthorId;
			print_r($qAuthorId);
			$sqlAuth = "UPDATE author SET  authorName = :authName WHERE authorId = :authpid;";



		}

		$query = $db->prepare($sql);
		$query->execute($databook);
		$dataBookAuth["pbookId"] = $db->lastInsertId();


		$queryAuth = $db->prepare($sqlAuth);
		$queryAuth->execute($dataAuth);

		if ($txtBookId == "") {
			$sqlBookAuth = "INSERT INTO book_author (bookId, authorId) VALUES (:pbookId, :pauthId );";
			$dataBookAuth["pauthId"] = $lastid + 1;

<<<<<<< HEAD
			$queryBookAuth = $db->prepare($sqlBookAuth);
			$queryBookAuth->execute($dataBookAuth);
		}
=======
      $queryBookAuth = $db->prepare($sqlBookAuth);			
      $queryBookAuth->execute($dataBookAuth); 


    }
>>>>>>> 72792248c7df0e1c1a929bef38895b1af0e12f85

	}

  header("location: stockAdmin.php");
   
}


?>

<<<<<<< HEAD
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
	<div class="row">
		<form class="col-sm-6 col-sm-offset-3" method="POST" enctype="multipart/form-data" action="stockAdmin.php">

			<p>
				<?= $errorMessages ?>
			</p>
			<div class="form-group">
				<input type="hidden" name="qAuthorId" value=<?= $qAuthorId; ?>>
				<input type="hidden" name="txtBookId" value=<?= $txtBookId; ?>>
				<label for="txtBookId" class="control-label">
					<?= $txtBookId ?? ""; ?>
				</label>

			</div>
			<div class="form-group">
				<label for="txtIsbn" class="control-label">ISBN </label>
				<input id="txtIsbn" name="txtIsbn" type="text" required="required" class="form-control"
					value="<?= $txtIsbn; ?>">
			</div>
			<div class="form-group">
				<label for="txtTitle" class="control-label">Title</label>
				<input id="txtTitle" name="txtTitle" type="text" required="required" class="form-control"
					value="<?= $txtTitle; ?>">
			</div>

			<div class="form-group">
				<label for="fileImage" class="control-label">Image</label>
				<input id="fileImage" name="fileImage" type="file" class="form-control">
			</div>
			<div class="form-group">
				<label for="txtDes" class="control-label">Description</label>
				<input id="txtDes" name="txtDesn" type="text" class="form-control" value="<?= $txtDes; ?>">
			</div>

			<div class="form-group">
				<label for="selCategory" class="control-label">Category</label>
				<select id="selCategory" name="selCategory" required="required" class="select form-control">
					<option value="">-----</option>
					<?php foreach ($rowCat as $cat_Id => $cat_name) {
						$selected = ($cat_Id == $selCategory) ? "selected" : "";
						?>
						<option value="<?= $cat_Id; ?>" <?= $selected; ?> multiple>
							<?= $cat_name; ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="txtAuthor" class="control-label">Author</label>
				<input id="txtAuthor" name="txtAuthor" type="text" required="required" class="form-control"
					value="<?= $txtAuthor; ?>">
			</div>
			<div class="form-group">
				<label for="txtStock" class="control-label">Stock Units</label>
				<input id="txtStock" name="txtStock" type="text" required="required" class="form-control"
					value="<?= $txtStock; ?>">
			</div>
			<div class="form-group">
				<label for="txtPrice" class="control-label">Unit Price ($)</label>
				<input id="txtPrice" name="txtPrice" type="text" required="required" class="form-control"
					value="<?= $txtPrice; ?>">
			</div>
			<div class="form-group">
				<button name="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
=======
<div class="row">
	<form class="col-sm-6 col-sm-offset-3" method="POST" enctype="multipart/form-data" action="editRecord.php">
		
	  <p><?=$errorMessages ?></p>
		<div class="form-group">
    <input type="hidden" name="qAuthorId" value=<?=$qAuthorId; ?> >
    <input type="hidden" name="txtBookId" value=<?=$txtBookId; ?> >
    <input type="hidden" name="oldImage" value="<?= $fileImage; ?>" ?>
			<label for="txtBookId" class="control-label">Book Id : <?=$txtBookId ?? ""; ?> </label>
			
		</div>
    <div class="form-group">
			<label for="txtIsbn" class="control-label">ISBN </label>
			<input id="txtIsbn" name="txtIsbn" type="text" required="required" class="form-control" value="<?=$txtIsbn; ?>">
		</div>
    <div class="form-group">
			<label for="txtTitle" class="control-label">Title</label>
			<input id="txtTitle" name="txtTitle" type="text" required="required" class="form-control" value="<?=$txtTitle; ?>">
		</div>
		
		<div class="form-group">
			<label for="fileImage" class="control-label">Image</label>
			<input id="fileImage" name="fileImage" type="file" class="form-control" >
		</div>
		<div class="form-group">
			<label for="txtDes" class="control-label">Description</label>
			<input id="txtDes" name="txtDes" type="text"  class="form-control" value="<?=$txtDes; ?>">
		</div>
    
		<div class="form-group">
			<label for="selCategory" class="control-label">Category</label>
			<select id="selCategory" name="selCategory" required="required" class="select form-control">
				<option value="">-----</option>
				<?php foreach($rowCat as $cat_Id => $cat_name){ 
					$selected = ($cat_Id == $selCategory) ? "selected" : "";
					?>
					<option value="<?=$cat_Id; ?>" <?=$selected; ?> multiple><?=$cat_name; ?></option>
				<?php } ?>
			</select>
		</div>
    <div class="form-group">
			<label for="txtAuthor" class="control-label">Author</label>
			<input id="txtAuthor" name="txtAuthor" type="text" required="required" class="form-control" value="<?=$txtAuthor; ?>">
		</div>
    <div class="form-group">
			<label for="txtStock" class="control-label">Stock Units</label>
			<input id="txtStock" name="txtStock" type="text" required="required" class="form-control" value="<?=$txtStock; ?>">
		</div>
    <div class="form-group">
			<label for="txtPrice" class="control-label">Unit Price ($)</label>
			<input id="txtPrice" name="txtPrice" type="text" required="required" class="form-control" value="<?=$txtPrice; ?>">
		</div>
		<div class="form-group">
			<button name="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
>>>>>>> 72792248c7df0e1c1a929bef38895b1af0e12f85


	</div>