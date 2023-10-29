<?php
require 'connectDb.php';

$sql  = "SELECT b.*, a.* FROM book b  join book_author ba ON b.bookId=ba.bookId  join author a ON ba.authorId=a.authorId";
$query = $db->query($sql);

/* 
$sqlCat  = "SELECT * FROM category";
$queryCat= $db->query($sqlCat);

$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);
print_r($rowCat);
print_r($rowCat['12']); */

$sqlCat  = "SELECT * FROM category";
$queryCat= $db->query($sqlCat);
$rowCat = $queryCat->fetchall(PDO::FETCH_KEY_PAIR);
?>


<div class="row">
  <h1>List of Books</h1>
  <!-- individual item START-->
  <?php while($rowBook = $query->fetch()){ $link = "singleBook.php?item=" .
  $rowBook['bookId']; ?>
  <div class="col-md-6 portfolio-item">
    <?php if ($rowBook['image'] != ""){ ?>
    <!-- check if image exists (else dummy photo ?) -->
    <a href="">
      <img class="img-responsive" src="<?=$rowBook['image']; ?>" alt />
    </a>
    <?php } //end if ?>
    <h3>
      <a href="<?=$link; ?>"><?=$rowBook['title']; ?></a><br>
      <span class="small">ISBN: 
        <?=$rowBook['isbn']; ?></span
      >
    </h3>
   
    <p><?php
    $id=$rowBook['catId']; 
     echo $rowCat[$id];
     ?>    </p>
    <p><?=$rowBook['authorName']; ?></p>
    <p><?=$rowBook['stockUnit']; ?></p>
    
    <p><?=$rowBook['unitPrice']; ?></p>
  </div>
  <?php } // end while ?>
  <!-- individual item END-->
</div>



<?php


?>
