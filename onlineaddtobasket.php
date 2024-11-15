<?php
include_once("connection.php");
session_start();

array_map("htmlspecialchars",$_POST);//prevents SQL injection by making special characters in the post array not have any impact

$date = date('Y-m-d');//sets the variable date to the current date

if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated) Values(:userid,:datecreated)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->execute();
    //This code inserts the UserID and date into the orders table which causes a new OrderID to be created because it is an auto-increment primary 
    //key. This OrderID will then be used to connect to the onlineorders table
    
    $stmt=$conn->prepare("SELECT MAX(OrderID) from Tblorders");//selects the largest OrderID from the table which will be the order which has 
    //just been created because the OrderID is autoincrement 
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];//sets the session orderid to the new one which has been created
    }
}

?> 


