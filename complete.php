<?php
include_once('connection.php');
session_start();


$stmt=$conn->prepare("UPDATE tblorders SET Paid=1 WHERE OrderID=:orderid");
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();

//mark order as completed
//unset OrderID
//mark paid as true

?>