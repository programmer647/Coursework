<?php
include_once("connection.php");
session_start();

$id=$_GET['id'];

$date = date('Y-m-d');

$stmt=$conn->prepare("UPDATE Tblorders SET Completed=1, Datecompleted=:date WHERE OrderID=:orderid ");
$stmt->bindParam(':orderid',$id);
$stmt->bindParam(':date',$date);
$stmt->execute();

?>
