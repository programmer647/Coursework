<?php
include_once("connection.php");
print_r($_POST);
session_start();

$stmt=$conn->prepare("UPDATE Tblusers SET Role=:role WHERE UserID=:id");
$stmt->bindParam(':role',$_POST['role']);
$stmt->bindParam(':id',$_SESSION['EditID']);
$stmt->execute();

?>


