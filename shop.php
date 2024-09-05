<?php
include_once("connection.php");//connects the page to the database
session_start();//starts the session so that session variables can be accessed

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Shop</title><!--sets the title of the page-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li class="active"><a href="shop.php">Shop</a></li><!--sets the shop page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <li><a href="news.php">News</a></li>
            <li><a href="faqs.php">FAQs</a></li>
            <li><a href="uniformlists.php">Uniform Lists</a></li>
            <li><a href="account.php">My Account</a></li>
            <li><a href="logout.php">Log out</a></li>

          </ul>
        </div>
      </nav>

      <body>


<div class="container-fluid">
<?php
$stmt=$conn->prepare("SELECT * FROM Tblitems");
$stmt->execute();

$k=0;

while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if ($k==0){
        echo('<div class=row>');
    }
    echo('<div class="col-sm-2">');
    $photo=$row['Photo'];
    echo("<img src=$photo class='shop'>");
    echo($row['Name']);
    echo('</div>');

    $k=$k+1;
    if ($k==6){
        echo('</div>');
    }
}

?>

</div>


