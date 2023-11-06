<?php




require 'connectDb.php';

$searchBy = "";
$searchTitle = "";
$txtSearch = "";
$noDataFound = "";

$sqlCat = "SELECT * FROM category";
$queryCat= $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);

$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";


if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $searchTitle = $_POST['searchTitle'];
  $txtSearch = $_POST['txtSearch'];

  if ($searchTitle == 3 ){
    $sql .= " order by b.title asc";
  } else if ($searchTitle == 4){
    $sql .= " order by b.title desc";
  }else if ($searchTitle == 5){
    $sql .= " order by b.unitPrice asc";
  } else if ($searchTitle == 6){
    $sql .= " order by b.unitPrice desc";
  } else if ($searchTitle == 7){
    $sql .= " order by b.catId, b.unitPrice asc";
  }else if ($searchTitle == 8){
    $sql .= " order by b.catId, b.unitPrice desc";
  }  else{
    
  }
  $query = $db->query($sql);
}





?>



<div class="container">
        
          <form class="search" action="searchupdate.php" method="post">
           
                   
            <div class="form-group">
              <label for="searchTitle" class="control-label">Search By:</label>
              <select id="searchTitle" name="searchTitle" required="required" class="select form-control">
              <option value="9">All</option>
              <option value="1">ISBN of Book</option>
                
              <option value="2"> Title of Book</option>
              <option value="3"> A-Z (Ascending Order)</option>
              <option value="4"> Z-A (Descending Order)</option>
              <option value="5"> Lower to Higher (Price)</option>
              <option value="6"> Higher to Lower (Price))</option>
              <option value="7"> Category with (Price Ascending))</option>
              <option value="8"> Category with (Price Descending))</option>

                
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
                    <th>Book ID </th>
                    <th>ISBN    </th>
                    <th>Title</th>
                    <th>Image   </th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Stock Unit</th>
                    <th>Unit Price</th>
                  </tr>
                <?php $count = 0;
                while($rowBook = $query->fetch()){ $link = "singleBook.php?item=" .
                  $rowBook['bookId'];  
                  
                  
                  if($searchTitle == 1 ){ 
                    $lentext = strlen($txtSearch);
                   
                    if (substr($rowBook['isbn'], 0, $lentext) == $txtSearch){ $count++; ?>
                      <div class="col-md-6 portfolio-item">
                
                        <tr style="text-align:center;">
                          <td><?=$rowBook['bookId']; ?></td>
                      
                      
                        

                          <td><span class="small"><?=$rowBook['isbn']; ?></td>
                          <td><a href="<?=$link; ?>"><?=$rowBook['title']; ?></td>
                          <td><?php if ($rowBook['image'] != ""){ ?>
                          <!-- check if image exists (else dummy photo ?) -->
                          <a href="">
                            <img class="img-responsive" src="<?=$rowBook['image']; ?>" width="80" 
                              height="100" alt />
                          </a>
                          <?php } else { echo "-"; } //end if ?></td>
                          <td><?php if ($rowBook['description'] == "" ){
                            echo "-"; } else{ echo $rowBook['description']; }
                          ?></td>
                          <td><?php $id=$rowBook['catId']; 
                          echo $rowCat[$id];
                          ?> </td>
                          <td><?=$rowBook['authorName']; ?></td>
                          <td><?=$rowBook['stockUnit']; ?></td>
                          <td><?=$rowBook['unitPrice']; ?></td>

                        
                        </tr>
                            
                      </div>
                    <?php 
                     
                    } 

              
                  } else if ($searchTitle == 2){ 
                  
                    $lentext = strlen($txtSearch);
                    
                    if (substr(strtoLower($rowBook['title']), 0, $lentext) == strtoLower($txtSearch)){  $count++; 
                     ?>
                      <div class="col-md-6 portfolio-item">
                
                        <tr style="text-align:center;">
                          <td><?=$rowBook['bookId']; ?></td>
                
                          <td><span class="small"><?=$rowBook['isbn']; ?></td>
                          <td><a href="<?=$link; ?>"><?=$rowBook['title']; ?></td>
                          <td><?php if ($rowBook['image'] != ""){ ?>
                          <!-- check if image exists (else dummy photo ?) -->
                          <a href="">
                            <img class="img-responsive" src="<?=$rowBook['image']; ?>" width="80" 
                               height="100" alt />
                          </a>
                          <?php } else { echo "-"; } //end if ?></td>
                          <td><?php if ($rowBook['description'] == "" ){
                            echo "-"; } else{ echo $rowBook['description']; }
                          ?></td>
                          <td><?php $id=$rowBook['catId']; 
                          echo $rowCat[$id];
                          ?> </td>
                          <td><?=$rowBook['authorName']; ?></td>
                          <td><?=$rowBook['stockUnit']; ?></td>
                          <td><?=$rowBook['unitPrice']; ?></td>
                        
                        </tr>
                   
                      </div>  
                    <?php 

                         
                    }
                     
                  }else { ?>
                    <div class="col-md-6 portfolio-item">
                      <tr style="text-align:center;">
                        <td><?=$rowBook['bookId']; ?></td>
                        <td><span class="small"><?=$rowBook['isbn']; ?></td>
                        <td><a href="<?=$link; ?>"><?=$rowBook['title']; ?></td>
                        <td><?php if ($rowBook['image'] != ""){ ?>
                        <!-- check if image exists (else dummy photo ?) -->
                        <a href="">
                          <img class="img-responsive" src="<?=$rowBook['image']; ?>" width="80" 
     height="100" alt />
                        </a>
                        <?php } else { echo "-"; } //end if ?></td>
                        <td><?php if ($rowBook['description'] == "" ){
                          echo "-"; } else{ echo $rowBook['description']; }
                        ?></td>
                        <td><?php $id=$rowBook['catId']; 
                        echo $rowCat[$id];
                        ?> </td>
                        <td><?=$rowBook['authorName']; ?></td>
                        <td><?=$rowBook['stockUnit']; ?></td>
                        <td><?=$rowBook['unitPrice']; ?></td>
                        
                      </tr>
                    </div>
                  <?php 
                  } 
                }  
                  
                 if ($count == 0 ){
                  $noDataFound = "Book Items not found";
                 } 
                if ($noDataFound !="" && $_POST['txtSearch'] != null){  echo $noDataFound;}  
                //end while 
                
                ?>
                          
              
        </form>
      </div>

    </div>



  
