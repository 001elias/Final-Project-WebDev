<?php
session_start();



require 'connectDb.php';
$statusMessages = "";

$qCustomerId = "";
$qCustomerEmail = "";
$qFname = "";
$qLname = "";
$qPhone = "";
$qAddress = "";

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
  $qFname = $rowCus['cusFirstName'] ?? "";
  $qLname = $rowCus['cusLastName'] ?? "";
  $qPhone = $rowCus['cusPhone'] ?? "";
  $qAddress = $rowCus['cusAddress'] ?? "";


}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $qCustomerEmail = $_POST['qCustomerEmail'] ?? "";
  $qCustomerId = $_POST['qCustomerId'] ?? "";
  $qFname = $_POST['qFname'] ?? "";
  $qLname = $_POST['qLname'] ?? "";
  $qPhone = $_POST['qPhone'] ?? "";
  $qAddress = $_POST['qAddress'] ?? "";

  $data['address'] = $qAddress;
  $data['num'] = $qPhone;
  $data['value'] = $qCustomerId;
  $query = $db->prepare("UPDATE customer SET cusPhone = :num, cusAddress = :address WHERE customerId = :value");

  $query->execute($data);



  $statusMessages = "$qCustomerEmail Password was changed successfully ";

  header("location: CustomerList.php");





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
    <form action="editCustomer.php" method="POST" enctype="">
      <p>
        <?= $statusMessages ?>
      </p>
      <input type="hidden" name="qCustomerId" value=<?= $qCustomerId; ?>>
      <input type="hidden" name="qCustomerEmail" value=<?= $qCustomerEmail; ?>>
      <input type="hidden" name="qFname" value=<?= $qFname; ?>>
      <input type="hidden" name="qLname" value=<?= $qLname; ?>>
      <div class="form-group">
        <label for="txtCustomerId" class="control-label">Customer Id :
          <?= $qCustomerId ?? ""; ?>
        </label>
      </div>
      <div class="form-group">
        <label for="txtEmail" class="control-label">Customer Email :
          <?= $qCustomerEmail ?? ""; ?>
        </label>
      </div>
      <div class="form-group">
        <label for="txtCustomerName" class="control-label">Customer Name :
          <?php echo $qFname . " " . $qLname; ?>
        </label>
      </div>
      <div class="form-group">
        <label for="qPhone" class="control-label">Customer Phone : </label>
        <input id="qPhone" name="qPhone" type="text" class="form-control" value="<?= $qPhone; ?>">
      </div>
      <div class="form-group">
        <label for="qAddress" class="control-label">Customer Address : </label>
        <input id="qAddress" name="qAddress" type="text" class="form-control" value="<?= $qAddress; ?>">
      </div>
      <div class="form-btn">
        <button name="btnSubmit" type="submit" class="btn btn-primary">Edit</button>

      </div>
    </form>
    <div>