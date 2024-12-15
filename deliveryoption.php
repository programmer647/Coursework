<?php
session_start();
include_once("connection.php");

$stmt=$conn->prepare("SELECT Name as n, Size as s, Price as p, Quantity as q, Total as t FROM Tblonlineorders 
INNER JOIN tblorders ON tblonlineorders.OrderID=tblorders.OrderID
INNER JOIN tbltype ON tblonlineorders.TypeID=tbltype.TypeID
INNER JOIN tblitems ON tbltype.ItemID=tblitems.ItemID
WHERE tblonlineorders.OrderID=:orderid");
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();
echo("Name, Size, Price, Quantity</br>");
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo($row['n'].", ".$row['s'].", £".$row['p'].", ".$row['q']."</br>");
    $total=$row['t'];
}
echo("£".$total);
?>

<br>

<h3>Delivery option</h3>
<form action="onlinecheckout.php" method="POST">
<input type="radio" name="option" value="home">
<label for="home">Home Delivery</label></br>
<input type="radio" name="option" value="collect">
<label for="collect">Collect from store</label></br>
<input type="radio" name="option" value="boarding">
<label for="boarding">Delivery to boarding house</label></br>

<input type="submit" value="Checkout">

</form>





