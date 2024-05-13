<?php
include("connection.php");
session_start();

array_map("htmlspecialchars",$_POST);//prevents SQL injection by making special characters in the post array not have any impact

$date = date('Y-m-d');//sets the variable date to the current date

//This if statement is to check if an OrderID has already been set for this order. If it hasn't then it does the code inside the brackets which 
//will set one by inserting data into the table. 
if (!isset($_SESSION['orderid']))
{
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated,Datecompleted) Values(:userid,:datecreated,:datecompleted)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->bindParam(':datecompleted',$date);
    $stmt->execute();
    //This code inserts the UserID and date into the orders table which causes a new OrderID to be created because it is an auto-increment primary 
    //key. This OrderID will then be used to connect to the basket table
    
    $stmt=$conn->prepare("SELECT MAX(OrderID) from TblOrders");//selects the largest OrderID from the table which will be the order which has 
    //just been created because the OrderID is autoincrement 
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];//sets the session orderid to the new one which has been created
    echo($_SESSION['orderid']);//prints the new orderid so that I can check that the code is working (this will be removed later)
    }
    
}


?>




