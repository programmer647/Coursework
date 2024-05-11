<?php
include("connection.php");
session_start();

array_map("htmlspecialchars",$_POST);//prevents SQL injection by making special characters in the post array not have any impact

//This if statement is to check if an orderid has already been set for this order. If it hasn't then it does the code inside the brackets which 
//will set one by inserting data into the table. 
if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID) Values(:userid)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->execute();
    $conn=null;
}

//This code inserts the UserID into the orders table which causes a new OrderID to be created because it is an auto-increment primary key. 
//This OrderID will then be used to connect to the basket table

?>

//page needs to create new order and then add appropriate items to basket table
//then all the complete page does is mark the order as completed in the table

//structure of orders table
//OrderID
//Total
//UserID
//Deliveryoption
//AddressLine1
//AddressLine2
//Postcode
//Paid
//Uniformready
//Completed
//Datecreated
//Datecompleted
