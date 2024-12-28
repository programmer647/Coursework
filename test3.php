<?php
session_start();
include_once("connection.php");

$total=9.5;
$stmt=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=1");
$stmt->bindParam(":total",$total);
$stmt->execute();
?>