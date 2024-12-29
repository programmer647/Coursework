<?php
session_start(); 
include_once("connection.php");
?>

<form action="addtobasket.php" method="POST">
<label for="barcode">Scan barcode:</label>
<input type="number" name="barcode"><br>
<label for="new">New?</label>
<input type="checkbox" name="new" value="1">
<br>
<input type="submit" value="Add to basket">

<br>
</form>

<form action="complete.php">
<input type="submit" value="Complete transaction">
</form>

<?php
//name, size, price, quantity


$stmt=$conn->prepare("SELECT tblitems.name as n, tbltype.size as s, tbltype.price as p, tblbasket.quantity as q, tblorders.OrderID, tblbasket.new as new FROM Tblorders
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
    if ($row['new']=1){
        echo($row['n'].', '.$row['s'].', '.$row['p']*1.65.', '.$row['q']);
    }
    else{
        echo($row['n'].', '.$row['s'].', '.$row['p'].', '.$row['q']);
    }
    
}

if (isset($_SESSION['orderid'])){
$stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
echo("<br>");
echo("Total: £".$row['Total']);
}

?>
