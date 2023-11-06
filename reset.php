<?php




require 'connectDb.php';
$errorMessages = "";
$txtNewP = "";
$txtRetype = ""; 
$qCustomerId = "";
$qCustomerEmail ="";

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
}

  

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $qCustomerEmail = $_POST['qCustomerEmail'] ?? "";
  $qCustomerId = $_POST['qCustomerId'] ?? "";
  $txtNewP = $_POST['txtNewP'];
  $txtRetype = $_POST['txtRetype']; 

  if ($txtNewP == $txtRetype){
    
    $data['updatePass'] = password_hash($txtNewP, PASSWORD_DEFAULT);;
    $data['value'] = $qCustomerId;   
    $query = $db->prepare("UPDATE customer SET cusPassword= :updatePass  WHERE customerId = :value");
    
    $query->execute($data);

    $errorMessages = "$qCustomerEmail Password was changed successfully ";
   

  } else {
      $errorMessages = "Password MisMatch. Please Re-enter Password";
   
  }
  $txtNewP = "";
  $txtRetype = ""; 



}
?>
<div class="row">
	<form class="col-sm-6 col-sm-offset-3" method="POST" enctype="multipart/form-data" action="reset.php">
		
	  <p><?=$errorMessages ?></p>
		<div class="form-group">
    <input type="hidden" name="qCustomerId" value=<?=$qCustomerId; ?> > 
    <input type="hidden" name="qCustomerEmail" value=<?=$qCustomerEmail; ?> > 
			
			
		</div>
    <div class="form-group">
    <label for="txtEmail" class="control-label">User Email :  <?=$rowCus['cusEmail'] ?? ""; ?></label>
			
		</div>
    <div class="form-group">
			<label for="txtNewP" class="control-label">New Password :      </label>
			<input id="txtNewP" name="txtNewP" type="password" required="required" class="form-control" value="<?=$txtNewP; ?>">
		</div>
		<div class="form-group">
			<label for="txtRetype" class="control-label">Re-type Password : </label>
			<input id="txtRetype" name="txtRetype" type="password" required="required" class="form-control" value="<?=$txtRetype; ?>">
		</div>
		
		<div class="form-group">
			<button name="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
      <button name="btnSubmit" onclick = "window.location.href='customerList.php';" class="btn btn-primary">Back to List</button>
		</div>
	</form>


</div>