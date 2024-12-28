<?php
session_start(); 
include_once("connection.php");
?>

<form action="addtobasket.php" method="POST">
<label for="uniformid">Scan barcode:</label>
<input type="number" name="barcode">
<br>
<input type="submit" value="Add to basket">
<br>
</form>

<form action="complete.php">
<input type="submit" value="Complete transaction">
</form>

<?php
//name, size, price, quantity


$stmt=$conn->prepare("SELECT tblitems.name as n, tbltype.size as s, tbltype.price as p, tblbasket.quantity as q, tblorders.OrderID FROM Tblorders
INNER JOIN Tblbasket on Tblbasket.OrderID=Tblorders.OrderID
INNER JOIN Tbluniform on Tbluniform.UniformID=Tblbasket.UniformID
INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID
INNER JOIN Tblitems on Tblitems.ItemID=Tbltype.ItemID
WHERE tblorders.OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
echo("Name, Size, Price, Quantity");
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<br>");
    echo($row['n'].', '.$row['s'].', '.$row['p'].', '.$row['q']);
}

$stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
echo("<br>");
echo("Total: £".$row['Total']);


?>
