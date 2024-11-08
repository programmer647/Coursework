<?php

include_once("connection.php");

echo('<form  action="onlineaddtobasket.php" method="post">');

$stmt=$conn->prepare("SELECT Price FROM Tbltype WHERE TypeID=:id");
$stmt->bindparam(":id", $_GET['q']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo("£".$row['Price']);


echo('<input type="hidden" name="TypeID" value=$_GET["q"]>');


$total=0;
$stmt=$conn->prepare("SELECT Stock from Tbluniform where TypeID=:typeid");
$stmt->bindParam(":typeid",$_GET['q']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $total=$total+$row['Stock'];
}

echo('</br>');

echo('<label for="quantity">Quantity</label>');
echo('<input type="number" id="quantity" name="quantity" min="1" max=$total>');

echo('<input type="submit" value="Add to basket">');

echo('</form>');

?>


