<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    
    <title>Barcode Checkout</title>

</head>
<body>

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