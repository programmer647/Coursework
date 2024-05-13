<?php
include("connection.php");
session_start();

array_map("htmlspecialchars",$_POST);//prevents SQL injection by making special characters in the post array not have any impact

$date = date('Y-m-d');//sets the variable date to the current date

//This if statement is to check if an orderid has already been set for this order. If it hasn't then it does the code inside the brackets which 
//will set one by inserting data into the table. 
if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated,Datecompleted) Values(:userid,:datecreated,:datecompleted)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->bindParam(':datecompleted',$date);
    $stmt->execute();
    $conn=null;
}
//This code inserts the UserID and date into the orders table which causes a new OrderID to be created because it is an auto-increment primary 
//key. This OrderID will then be used to connect to the basket table

?>
