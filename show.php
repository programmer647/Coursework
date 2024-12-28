<?php
include_once("connection.php");

$stmt=$conn->prepare("SELECT * FROM Tblhouse");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $housetotals[$row['HouseID']]
}

?>

