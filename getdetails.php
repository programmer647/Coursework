<?php

include_once("connection.php");

echo('<form  action="onlineaddtobasket.php" method="post">');

$stmt=$conn->prepare("SELECT Price FROM Tbltype WHERE TypeID=:id");
$stmt->bindparam(":id", $_GET['q']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo("£".$row['Price']);

$id=$_GET['q'];
?>

<input type="hidden" name="TypeID" value='<?php echo($id);?>'>

<?php
$total=0;
$stmt=$conn->prepare("SELECT Stock from Tbluniform where TypeID=:typeid");
$stmt->bindParam(":typeid",$_GET['q']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $total=$total+$row['Stock'];
}

?>

</br>

<label for="quantity">Quantity</label>
<input type="number" id="quantity" name="quantity" min="1" max="<?php echo($total);?>">

<input type="submit" value="Add to basket">

</form>



