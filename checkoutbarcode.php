<?php
session_start(); 
include_once("connection.php");
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
            <li class="active"><a href="checkoutbarcode.php">Barcode checkout</a></li>
            <li><a href="showtotals.php">View totals</a></li>
            <li><a href="login.php">Login</a></li>

          </ul>
        </div>
      </nav>







      
<form action="addtobasket.php" method="POST"><!--Creates the form where the information can be entered. Also sets the page to submit 
the information to and the way to do it which is through the post function. -->
  Scan barcode:<input type="text" name="barcode"><br><!--Provides a box to input the barcode-->
  <input type ="submit" value="Add to basket"><!--Allows the information to be submitted by providing a button to do it-->
</form>

<form action="checkoutmanual.php"><!--sets the page to redirect to when the button is pressed-->
  <input type="submit" value="Or enter details manually"><!--Creates a button to redirect to the manual checkout page-->
</form>



<?php
if (isset($_SESSION['orderid'])){
 // $stmt=$conn->prepare("SELECT * FROM tblbasket where OrderID=:orderid");
 //$stmt->bindParam(':orderid',$_SESSION['orderid']);
  

  $stmt=$conn->prepare("SELECT Tblbasket.Quantity as q, Tbltype.Name as name, Tbltype.Price as cost, Tbltype.Size1, Tbltype.Size2, Tblhouse.name as n FROM Tblbasket
  INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
  INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID 
  INNER JOIN Tblhouse on Tbluniform.HouseID=Tblhouse.HouseID
  WHERE OrderID=:orderid");
  $stmt->bindParam(':orderid',$_SESSION['orderid']);
  $stmt->execute();
  echo("Item, Size, Cost, Quantity");
  echo("</br>");
  while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    
    echo($row['n'].', '.$row['name'].', ' .$row['Size1'].' '.$row['Size2'].', £'.$row['cost'].', '.$row['q']);
    echo("</br>");
    
  }


  $stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
  $stmt->bindParam(':orderid',$_SESSION['orderid']);
  $stmt->execute();
  while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    echo("</br>");
    echo('Total:');
    echo("</br>");
    echo('£'.$row['Total']);
    echo("</br>");
  }
}

?>
<form action="complete.php"><!--sets the page to redirect to when the button is pressed-->
  <input type="submit" value="Complete transaction"><!--Creates a button to complete the order by redirecting to the complete.php page-->
</form>

</body>
</html>

