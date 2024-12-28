<?php
session_start();
include_once("connection.php");

$stmt=$conn->prepare("UPDATE Tblorders SET Paid=1, Completed=1, Usercompleted=1, Uniformready=1 WHERE OrderID=:orderid");
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();

unset($_SESSION['orderid']);

echo("Transaction completed");
?>


