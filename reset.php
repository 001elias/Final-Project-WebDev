<?php




require 'connectDb.php';
$errorMessages = "";
$txtNewP = "";
$txtRetype = "";
$qCustomerId = "";
$qCustomerEmail = "";

if (array_key_exists('id', $_GET)) {
  $qCustomerId = $_GET['id'];
  $data = ['value' => $qCustomerId];
  $sql = "SELECT * FROM customer WHERE customerId = :value";
  $query = $db->prepare($sql);
  $query->execute($data);

  $rowCus = $query->fetch();
  if (!$rowCus) {
    echo "Page Not Found";
  }

  $qCustomerEmail = $rowCus['cusEmail'] ?? "";
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $qCustomerEmail = $_POST['qCustomerEmail'] ?? "";
  $qCustomerId = $_POST['qCustomerId'] ?? "";
  $txtNewP = $_POST['txtNewP'];
  $txtRetype = $_POST['txtRetype'];

  if ($txtNewP == $txtRetype) {

    $data['updatePass'] = password_hash($txtNewP, PASSWORD_DEFAULT);
    ;
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
  <form class="col-sm-6 col-sm-offset-3" method="POST" enctype="multipart/form-data" action="reset.php">

    <p>
      <?= $errorMessages ?>
    </p>
    <div class="form-group">
      <input type="hidden" name="qCustomerId" value=<?= $qCustomerId; ?>>
      <input type="hidden" name="qCustomerEmail" value=<?= $qCustomerEmail; ?>>


    </div>
    <div class="form-group">
      <label for="txtEmail" class="control-label">User Email :
        <?= $rowCus['cusEmail'] ?? ""; ?>
      </label>

    </div>
    <div class="form-group">
      <label for="txtNewP" class="control-label">New Password : </label>
      <input id="txtNewP" name="txtNewP" type="password" required="required" class="form-control"
        value="<?= $txtNewP; ?>">
    </div>
    <div class="form-group">
      <label for="txtRetype" class="control-label">Re-type Password : </label>
      <input id="txtRetype" name="txtRetype" type="password" required="required" class="form-control"
        value="<?= $txtRetype; ?>">
    </div>

    <div class="form-group">
      <button name="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
      <button name="btnSubmit" onclick="window.location.href='customerList.php';" class="btn btn-primary">Back to
        List</button>
    </div>
  </form>


</div>