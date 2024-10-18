<?php

include_once("connection.php");
print_r($_GET);
$stmt=$conn->prepare("SELECT Price FROM Tbltype WHERE TypeID=:id");
$stmt->bindparam(":id", $_GET['q']);
$stmt->execute();
//$row=$stmt->fetch(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
  }

//echo($row['Price']);

?>