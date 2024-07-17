<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    
    <title>Barcode Checkout</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>


<nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="checkoutbarcode.php">Barcode checkout</a></li>
            <li><a href="showtotals.php">View totals</a></li>
            <li><a href="login.php">Login</a></li>

          </ul>
        </div>
      </nav>



<?php
include_once('connection.php');



$stmt=$conn->prepare("UPDATE Tblorders SET Paid=1 WHERE OrderID=:orderid");
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();

unset($_SESSION['orderid']);

echo("Transaction completed");
echo("</br>");
echo("Click on the barcode checkout button above to do another transaction");


?>


</body>
</html>