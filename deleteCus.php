<?php




require 'connectDb.php';


 

$data = ['value'=>$_GET['id']];
// does the item exists in the database
$sql  = "SELECT * FROM customer WHERE customerId = :value";
  $query = $db->prepare($sql);
  $query->execute(['value'=>$_GET['id']]);

  $rowCus =$query->fetch();
if (!$rowCus){
	echo "Page Not Found";
}



$query = $db->prepare("DELETE FROM customer WHERE customerId = :value");
$query->execute(["value"=> $rowCus['customerId']]);
// delete if exists

$email = $rowCus['cusEmail'];

//echo "<script>alert('$email is successfully deleted');</script>";
header("location: customerList.php");

?>
