<?php
include_once("connection.php");
session_start();
print_r($_SESSION);

$stmt=$conn->prepare("DELETE FROM Tblusers WHERE UserID=:id");
$stmt->bindParam(':id',$_SESSION['EditID']);
$stmt->execute();

?>