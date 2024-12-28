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

$uniformid=$_POST['barcode'];
$quantity=1;//sets the quantity to one as only 1 item is scanned at once

$stmt=$conn->prepare("SELECT * FROM Tblbasket WHERE OrderID=:orderid and UniformID=:uniform");//checks to see if there is already an item of the same type in the basket and 
//if there is it takes the quantity of it so that this can be altered and then updated
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->bindParam(':uniform',$uniformid);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    print_r($row);
    $q=$row['Quantity'];
    if ($q>0){
        $quantity=$q+1;
    }
}

if ($quantity>1){//checks if the quantity is greater than 1 as when this is the case the table needs to be updated
    $stmt=$conn->prepare("UPDATE Tblbasket SET Quantity=:quantity WHERE UniformID=:uniform");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam('uniform',$uniformid);
    $stmt->execute();
}

else{//because there is not already an item of the same type in the basket the 
    $stmt=$conn->prepare("INSERT INTO Tblbasket(OrderID,UniformID,Quantity) VALUES (:orderid,:uniformid,:quantity)");
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->bindParam(':uniformid',$uniformid);
    $stmt->bindParam(':quantity',$quantity);
    $stmt->execute();
}


//SQL statement to select the price from the type table
$stmt=$conn->prepare("SELECT Price as p FROM Tbltype 
INNER JOIN tbluniform on tbluniform.TypeID=tbltype.TypeID 
WHERE UniformID=:uniformid");
$stmt->bindParam(":uniformid",$uniformid);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
print_r($row);
$price=$row['p'];

//SQL statement to select the total from the orders table
$stmt=$conn->prepare("SELECT Total FROM Tblorders WHERE OrderID=:orderid");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
print_r($row);
$tot=$row['Total'];
$total=$tot+$price;
echo($total);

//statement to update the total in the table
$stmt=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=:orderid");
$stmt->bindParam(":total",$total);
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
?>




