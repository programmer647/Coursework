<?php
include_once("connection.php");
session_start();

$stmt=$conn->prepare("DELETE FROM Tblusers WHERE UserID=:id");
$stmt->bindParam(':id',$_SESSION['EditID']);
$stmt->execute();

?>

