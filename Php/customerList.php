<?php




require 'connectDb.php';

$searchBy = "";
$searchTitle = "";
$txtSearch = "";
$noDataFound = "";
$lentext = "";

$sqlCus = "SELECT * FROM customer";
$queryCus= $db->query($sqlCus);
//$rowCus = $queryCus->fetchall();

////$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
//$query = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $searchTitle = $_POST['searchTitle']??"";
  $txtSearch = $_POST['txtSearch']??"";
  
}


?>



<div class="container">
        
          <form class="search" action="customerList.php" method="post">
           
                   
            <div class="form-group">
              <label for="searchTitle" class="control-label">Search By:</label>
              <select id="searchTitle" name="searchTitle" required="required" class="select form-control">
              <option value="2">All</option>
              <option value="1">Customer email Id :</option>
                
                 
                
              </select>
            </div>
		        <div class="form-group">
                <input type="text" placeholder="" name="txtSearch" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="search" name="search" class="btn btn-primary">
            </div>
             

            
                <div class="row">
                <p><h1>List of Books</h1></p>
                <p></p>
                <table>
                  <tr>
                    <th>Customer ID </th>
                    <th>Email Id </th>
                    <th>First Name</th>
                    <th>Last Name  </th>
                    <th>Phone No.</th>
                    <th>Address </th>
                   <th>Customer Password </th>
                  </tr>
                <?php while($rowCus = $queryCus->fetch()){ $link = "editCustomer.php?id=" .
                  $rowCus['customerId'];  
                 
                  if($searchTitle == 1 ){ 
                    $lentext = strlen($txtSearch);
                   
                    if (substr(strtoLower($rowCus['cusEmail']), 0, $lentext) == strtoLower($txtSearch)){ ?>
                   
                      <div class="col-md-6 portfolio-item">
                
                        <tr style="text-align:center;">
                          <td><?=$rowCus['customerId']; ?></td>
                          <td><a href="<?=$link; ?>"><span class="small"><?=$rowCus['cusEmail']; ?></td>
                          <td><?=$rowCus['cusFirstName']; ?></td>
                          <td><?=$rowCus['cusLastName']; ?></td>
                          <td><?=$rowCus['cusPhone']; ?></td>
                          <td><?=$rowCus['cusAddress']; ?></td>
                          <td><?=$rowCus['cusPassword']; ?></td>
                          <td><a href="reset.php?id=<?=$rowCus['customerId']; ?>">Reset Password</a></td>
                          <td><a href="deleteCus.php?id=<?=$rowCus['customerId']; ?>">Delete</a></td>
                        </tr>
               
                      </div>
                    <?php 
                    } else { 
                      $noDataFound = "User Email Id not found";
                      
                    }

              
                  } else { 
                  
                    
                   ?>
                      <div class="col-md-6 portfolio-item">
                
                        <tr style="text-align:center;">
                          <td><?=$rowCus['customerId']; ?></td>
                          <td><a href="<?=$link; ?>"><span class="small"><?=$rowCus['cusEmail']; ?></td>
                          <td><?=$rowCus['cusFirstName']; ?></td>
                          <td><?=$rowCus['cusLastName']; ?></td>
                          <td><?=$rowCus['cusPhone']; ?></td>
                          <td><?=$rowCus['cusAddress']; ?></td>
                          <td><?=$rowCus['cusPassword']; ?></td>
                          <td><a href="reset.php?id=<?=$rowCus['customerId']; ?>">Reset Password</a></td>
                          <td><a href="deleteCus.php?id=<?=$rowCus['customerId']; ?>">Delete</a></td>
                        </tr>
               
                      </div>
                    <?php 
                    


                  }
                 
                 
                }  
                  
                  
                if ($noDataFound !="" && $_POST['txtSearch'] != null){  echo $noDataFound;}  
                //end while 
                
                ?>
                          
              
        </form>
      </div>

    </div>



  
