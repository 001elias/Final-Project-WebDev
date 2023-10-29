<?php

/* require "vendor/autoload.php";

//setup my monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log_portfolio = new Logger("PORTFOLIO");
$log_portfolio->pushHandler( new StreamHandler('logs/portfolio.log') );
$log_users = new Logger("USERS");
$log_users->pushHandler( new StreamHandler('logs/users.log') ); */

//session_start();
//$userIsLoggedIn = $_SESSION['loggedIn'] ?? false;
//$userIsLoggedIn = $_COOKIE['cLoggedIn'] ?? false;


//require "includes/functions.php";


//Variable
$dbType = "mysql"; //type of database
$dbServer = "localhost";  //host name of server
$dbName = "fsd10_yankee";  //name of database
$dbPort = "3304";
$dbCharset = "utf8";
$dbUsername = "fsduser";  //user 
$dbPassword = "myDBpw";  //password


//connection string (data source name)
$dbDSN ="{$dbType}:host={$dbServer};dbname={$dbName};port={$dbPort};charset={$dbCharset}";

//open database connection
$db = new PDO($dbDSN, $dbUsername, $dbPassword);





// $allCategories contains all the book from the DB
$sql="SELECT * FROM book";
$query = $db->query($sql);
$allBooks = $query->fetchall();
//print_r($allBooks);
// PDO::FETCH_KEY_PAIR changes the way the results are returned




//print_r($category);

/*
// query my database
$sql ="Select * from portfolio";

//setup the query
$query = $db->query($sql);
$queryWhile = $db->query($sql);

//$results = $query->fetch();
//$results = $query->fetch();
$results = $query->fetchall();


echo "<pre>";
//print_r($results);

for ($x = 0;$x < sizeof($results); $x++){
  echo $results[$x]['title'].'<br>';
}

foreach($results as $row)
  echo $row['title'].'<br>';

while ($row = $queryWhile->fetch()){
  echo $row['title'].'<br>';
}

// no record found
$sql ="Select * from portfolio Where 1=2";

//setup the query
$queryEmpty = $db->query($sql);
$resultsEmpty = $queryEmpty->fetch();

if(!$resultsEmpty){
  echo "No records were found";
}

//place holder preceeded by : to replace with given value catid or anyword
$category_id = 2;
$sql ="Select * from portfolio WHERE portfolio_id = :portid AND category_id = :catid";
$query = $db->prepare($sql);


$query->execute(['portid' =>1,'catid'=> $category_id]);
$results = $query->fetch();
print_r($results);
*/
?>