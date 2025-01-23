<?php
session_start();
include_once("connection.php");
if ($_SESSION['role']==1){
    echo("<script>alert('You do not have permission to access this page');
    window.location.href = 'customerhome.php';</script>");
}

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>View orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="stock.php">Add Stock</a></li>
            <li><a href="generate.php">Generate Barcodes</a></li>
            <li><a href="checkout.php">Checkout System</a></li>
            <li class="active"><a href="vieworders.php">View Orders</a></li>
            <li><a href="account.php">My Account</a></li>
            <li><a href="logout.php">Log Out</a></li>

          </ul>
        </div>
      </nav>



<body>

<div class="container-fluid">
<div class="row">
<div class="col-sm-6">
<h2>Pending</h2>
<?php
$stmt=$conn->prepare("SELECT OrderID FROM Tblorders WHERE Usercompleted=1 AND Uniformready=0 AND Online=1");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='detailedorder.php?id=".$row['OrderID']."'>");
    echo("<button>");
    echo($row['OrderID']);
    echo("</button>");
    echo("</a>");
    echo("<br>");
}
?>
</div>

<div class="col-sm-6">
<h2>Ready for dispatch</h2>
<?php
$stmt=$conn->prepare("SELECT OrderID FROM Tblorders WHERE Usercompleted=1 AND Uniformready=1 AND Completed=0 AND Online=1");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='onlinecomplete.php?id=".$row['OrderID']."'>");
    echo("<button>");
    echo($row['OrderID']);
    echo("</button>");
    echo("</a>");
    echo("<br>");
}
?>

</div>
</div>
</div>

</body>

