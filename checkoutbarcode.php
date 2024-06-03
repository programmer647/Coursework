<!DOCTYPE html>
<html>
<head>
    
    <title>Checkout</title>
    
</head>
<body>


<?php
session_start(); 
include_once("connection.php");
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
 // $stmt=$conn->prepare("SELECT * FROM tblbasket where OrderID=:orderid");
 //$stmt->bindParam(':orderid',$_SESSION['orderid']);
  

  $stmt=$conn->prepare("SELECT tblbasket.Quantity as q, tbltype.Name as name, tbltype.Price as cost FROM tblbasket
  INNER JOIN tbluniform on tblbasket.UniformID=tbluniform.UniformID
  INNER JOIN tbltype on tbltype.TypeID=tbluniform.TypeID 
  WHERE OrderID=:orderid");
  $stmt->bindParam(':orderid',$_SESSION['orderid']);
  $stmt->execute();
  echo("Item, Cost, Quantity");
  echo("</br>");
  while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    
    echo($row['name'].', '.$row['cost'].', '.$row['q']);
    echo("</br>");
  }

}


?>


</body>
</html>

