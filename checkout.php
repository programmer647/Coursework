<!DOCTYPE html>
<html>
<head>
    
    <title>Checkout</title>
    
</head>
<body>



<?php
session_start(); 

?>

      
<form action="addtobasket.php" method="post">
  Scan barcode:<input type="text" name="barcode"><br>
  <input type ="submit" value="Add to basket">
</form>




</body>
</html>