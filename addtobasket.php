<?php
session_start();
include_once("connection.php");
print_r($_POST);

$date = date('Y-m-d');

if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated,Datecompleted) Values(:userid,:datecreated,:datecompleted)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->bindParam(':datecompleted',$date);
    $stmt->execute();
    
    $stmt=$conn->prepare("SELECT MAX(OrderID) from Tblorders");
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];
    }
}

?>



