<?php




require 'connectDb.php';

$searchBy = "";
$searchTitle = "";
$txtSearch = "";

$sqlCat = "SELECT * FROM category";
$queryCat= $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);

$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
$query = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $searchBy = $_POST['searchBy'];
    
    
}

?>



<div class="container">
        
          <form class="search" action="search.php" method="post">
           
            <div class="form-group">
              <label for="searchBy" class="control-label">Category</label>
              <select id="searchBy" name="searchBy"  class="select form-control">
                <option value="">-----</option>
                <?php foreach($rowCat as $cat_id => $cat_name){ 
                  $selected = ($cat_id == $searchBy) ? "selected" : "";
                  ?>
                  <option value="<?=$cat_id; ?>" <?=$selected; ?>><?=$cat_name; ?></option>
                <?php } ?>
              </select>
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
                    <?php while($rowBook = $query->fetch()){ $link = "singleBook.php?item=" .
                    $rowBook['bookId']; 
                    
                     if ($searchBy == $rowBook['catId'] ){ ?>
                    <div class="col-md-6 portfolio-item">
                    
                     
                    <tr style="text-align:center;">
                        <td><?=$rowBook['bookId']; ?></td>
                        <td><span class="small"><?=$rowBook['isbn']; ?></td>
                        <td><a href="<?=$link; ?>"><?=$rowBook['title']; ?></td>
                        <td><?php if ($rowBook['image'] != ""){ ?>
                        <!-- check if image exists (else dummy photo ?) -->
                        <a href="">
                          <img class="img-responsive" src="<?=$rowBook['image']; ?>" alt />
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
                  } // end while  ?>
        
        </form>
</div>

    </div>



  
