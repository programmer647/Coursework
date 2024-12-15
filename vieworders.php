<?php
session_start();
include_once("connection.php");

$stmt=$conn->prepare("SELECT OrderID FROM Tblorders WHERE Usercompleted=1 AND Uniformready=0");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='detailedorder.php?id=".$row['OrderID']."'>");
    echo("<button>");
    echo($row['OrderID']);
    echo("</button>");
    echo("</a>");
    echo("<br>");
}

?>






