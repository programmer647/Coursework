<?php
include_once("connection.php");
session_start();

$stmt=$conn->prepare("SELECT tbluniform.UniformID, tbltype.Size, tblhouse.Name FROM Tbluniform
INNER JOIN Tbltype ON Tbltype.TypeID=Tbluniform.UniformID
INNER JOIN Tblhouse ON Tblhouse.HouseID=tbluniform.HouseID");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
    // echo("<a href='barcode.orcascan.com/?type=code39&data=1&text=test'>");
    // echo("<button>");
    // echo($row['UniformID']);
    // echo("</button>");
    // echo("</a>");
    // echo("<br>");
}

//name
//size
//house
//echo("<a href='onlinecomplete.php?id=".$row['OrderID']."'>");

?>
<!-- https://barcode.orcascan.com/?type=code39&data=1&text=test -->
<!-- 
<a href=https://barcode.orcascan.com/?type=code128&data=Hello%20World></a> -->
