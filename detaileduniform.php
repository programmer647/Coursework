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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
            <?php
            if (!isset($_SESSION['name'])){
                echo("<li><a href='login.php'>Login/Sign up</a></li>");
            }
            else{
                echo("<li><a href='account.php'>My Account</a></li>
                <li><a href='logout.php'>Log out</a></li>");
            }
            ?>

          </ul>
        </div>
      </nav>

      <body>

<button onclick="location.href='shop.php'" type="button" class="btn btn-secondary" action="shop.php">Back</button>

<?php

$id=$_GET['id'];


$stmt=$conn->prepare("SELECT Name, Photo FROM Tblitems where ItemID=:id");
$stmt->bindparam(':id',$id);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$photo=$row['Photo'];
$name=$row['Name'];
?>

<div class="container-fluid" >
<div class="row">

<div class="col-sm-6">
<?php
echo("<h1 style='Text-align:center'>$name</h1>")
?>

<form method="get">
<select onchange="getdetails(this.value)">
  <option value="">Select size</option>
  <?php
  $stmt=$conn->prepare("SELECT TypeID, Size FROM Tbltype Where ItemID=:id");
  $stmt->bindparam(':id',$id);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo('<option value='.$row['TypeID'].'>'.$row['Size'].'</option>');
  }
  ?>

</select>

</form>

<div id="price">

</div>


</div>

<div class="col-sm-6">
<?php
echo("<img src=$photo class='centre'>");
;
?>

</div>

</div>

</div>

<script>
function getdetails(str){
  const xhttp = new XMLHttpRequest();
  xhttp.onload=function(){
    document.getElementById("price").innerHTML = this.responseText;
  }
  xhttp.open("GET","getdetails.php?q="+str);
  xhttp.send();
}

</script>


</body>

</html>