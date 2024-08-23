<?php
include_once("connection.php");
session_start();

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li class="active"><a href="shop.php">Shop</a></li><!--sets the home page to the active link so that it appears a different 
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
<div class="row">

<div class="col-sm-2">
<a href="culottes.php"><img src=images/culottes.jpg class="shop"></a>
<h4><center>Culottes<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Culottes'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

<div class="col-sm-2">
<a href="trousers.php"><img src=images/trousers.jpg class="shop"></a>
<h4><center>Trousers<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Trousers'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

<div class="col-sm-2">
<a href="culottewhitet-shirt.php"><img src=images/culottewhitet-shirt.jpg class="shop"></a>
<h4><center>White T-shirt - Culotte uniform<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='White T-Shirt'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

<div class="col-sm-2">
<a href="trouserwhitet-shirt.php"><img src=images/trouserwhitet-shirt.jpg class="shop"></a>
<h4><center>White T-shirt - Trouser uniform<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='White T-Shirt'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>
   
<div class="col-sm-2">
<a href="navyjumper.php"><img src=images/navyjumper.jpg class="shop"></a>
<h4><center>Navy Jumper<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Navy Jumper'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

<div class="col-sm-2">
<a href="pinkculotteshirt.php"><img src=images/pinkculotteshirt.jpg class="shop"></a>
<h4><center>Pink Shirt - Culotte Uniform<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Sky Blue Jumper'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

</div>

<div class="row">
<div class="col-sm-2">
<a href="overcoat.php"><img src=images/Overcoat.jpg class="shop"></a>
<h4><center>Overcoat<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Overcoat'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>

<div class="col-sm-2">
<a href="tie.php"><img src=images/schooltie.jpg class="shop"></a>
<h4><center>Ties<center></h4>
<?php
$stmt=$conn->prepare("SELECT MAX(Price) FROM Tbltype WHERE name='Tie'");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<h5><center>Up to £'.$row['MAX(Price)'].'<center><h5>');
    
}
?>
</div>


</div>

</div>

</div>


