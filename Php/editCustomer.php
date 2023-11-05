
<?php




require 'connectDb.php';
$statusMessages = "";

$qCustomerId = "";
$qCustomerEmail ="";
$qFname = "";
$qLname = "";
$qPhone = "";
$qAddress = "";

if (array_key_exists('id',$_GET)){
  $qCustomerId = $_GET['id'];
  $data = ['value' => $qCustomerId];
  $sql  = "SELECT * FROM customer WHERE customerId = :value";
    $query = $db->prepare($sql);
    $query->execute($data);

    $rowCus =$query->fetch();
  if (!$rowCus){
    echo "Page Not Found";
  }
  

  $qCustomerEmail =$rowCus['cusEmail'] ??"";
  $qFname =$rowCus['cusFirstName'] ??"";
  $qLname =$rowCus['cusLastName'] ??"";
  $qPhone =$rowCus['cusPhone'] ??"";
  $qAddress =$rowCus['cusAddress'] ??"";


}

  

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $qCustomerEmail = $_POST['qCustomerEmail'] ?? "";
  $qCustomerId = $_POST['qCustomerId'] ?? "";
  $qFname =$_POST['qFname'] ?? "";
  $qLname =$_POST['qLname'] ?? "";
  $qPhone =$_POST['qPhone'] ?? "";
  $qAddress =$_POST['qAddress'] ?? "";

  $data ['address'] = $qAddress;
  $data ['num'] = $qPhone;
  $data['value'] = $qCustomerId;   
  $query = $db->prepare("UPDATE customer SET cusPhone = :num, cusAddress = :address WHERE customerId = :value");
  
  $query->execute($data);

  
   
  $statusMessages = "$qCustomerEmail Password was changed successfully ";
   
  header("location: CustomerList.php");
   
 



}
?>


<div class="container">
        <form action="editCustomer.php" method="POST" enctype="" >
        <p><?=$statusMessages ?></p>
            <input type="hidden" name="qCustomerId" value=<?=$qCustomerId; ?> > 
            <input type="hidden" name="qCustomerEmail" value=<?=$qCustomerEmail; ?> > 
            <input type="hidden" name="qFname" value=<?=$qFname; ?> > 
            <input type="hidden" name="qLname" value=<?=$qLname; ?> > 
            <div class="form-group">
              <label for="txtCustomerId" class="control-label">Customer Id :    <?=$qCustomerId ?? ""; ?> </label>
            </div>
            <div class="form-group">
              <label for="txtEmail" class="control-label">Customer Email : <?=$qCustomerEmail ?? ""; ?> </label>
            </div>
            <div class="form-group">
              <label for="txtCustomerName" class="control-label">Customer Name : <?php echo $qFname . " ". $qLname; ?> </label>
            </div>
            <div class="form-group">
              <label for="qPhone" class="control-label">Customer Phone : </label>
              <input id="qPhone" name="qPhone" type="text"  class="form-control" value="<?=$qPhone; ?>">
            </div>
            <div class="form-group">
              <label for="qAddress" class="control-label">Customer Address : </label>
              <input id="qAddress" name="qAddress" type="text" class="form-control" value="<?=$qAddress; ?>">
            </div>
            <div class="form-btn">
                <button name="btnSubmit" type="submit" class="btn btn-primary">Edit</button>
                
            </div>
        </form>
    <div>