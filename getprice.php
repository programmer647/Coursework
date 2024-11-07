<?php

include_once("connection.php");
$stmt=$conn->prepare("SELECT Price FROM Tbltype WHERE TypeID=:id");
$stmt->bindparam(":id", $_GET['q']);
$stmt->execute();
//$row=$stmt->fetch(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo("£".$row['Price']);
  }

//echo($row['Price']);

?>
