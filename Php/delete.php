<?php




require 'connectDb.php';


 

$data = ['value'=>$_GET['id']];
// does the item exists in the database
$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId WHERE b.bookId = :value";
  $query = $db->prepare($sql);
  $query->execute(['value'=>$_GET['id']]);

  $qbook =$query->fetch();
if (!$qbook){
	echo "Page Not Found";
}


$txtBookId = $qbook['bookId'];
$txtIsbn = $qbook['isbn'];
$txtTitle = $qbook['title'];
$fileImage = $qbook['image'];
$txtDes = $qbook['description'];
$selCategory =$qbook['catId'];
$qAuthorId = $qbook['authorId'];
$txtAuthor = $qbook['authorName'];
$txtStock = $qbook['stockUnit'];
$txtPrice = $qbook['unitPrice'];

$query = $db->prepare("DELETE FROM book_author WHERE bookId = :value");
$query->execute(["value"=> $qbook['authorId']]);
// delete if exists
$query = $db->prepare("DELETE FROM book WHERE bookId = :value");
$query->execute($data);

$query = $db->prepare("DELETE FROM author WHERE authorId = :value");
$query->execute(['value' => $qbook['authorId']] );




// remove the image if exist
if ($qbook['image'] != "")
	unlink ($qbook['image']);

// redirect to index (or tell user "entry removed")
//pageTitle = "Remove Item";

echo "<p>" . $qbook['title'] . " has been successfully removed" . "</p>";
header("location: stockAdmin.php");

?>