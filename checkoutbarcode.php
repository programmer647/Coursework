<!DOCTYPE html>
<html>
<head>
    
    <title>Checkout</title>
    
</head>
<body>


<?php
session_start(); 
?>

      
<form action="addtobasket.php" method="POST"><!--Creates the form where the information can be entered. Also sets the page to submit 
the information to and the way to do it which is through the post function. -->
  Scan barcode:<input type="text" name="barcode"><br><!--Provides a box to input the barcode-->
  <input type ="submit" value="Add to basket"><!--Allows the information to be submitted by providing a button to do it-->
</form>

<form action="checkoutmanual.php" method="post"><!--sets the page to redirect to when the button is pressed-->
  <input type="submit" value="Or enter details manually"><!--Creates a button to redirect to the manual checkout page-->
</form>

<?php
if (isset($_SESSION['orderid'])){
  $stmt->prepare("SELECT * FROM tblbasket WHERE OrderID=:orderid");
  $stmt->bindParam(':orderid',$_SESSION('orderid'));
  while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    print_r($row);
  }

}

?>

</body>
</html>



