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

//everything past this point copied from addtobasket page so may not be accurate
$typeid=$_POST['TypeID'];//retrieves the barcode entered on the previous page and sets a variable for it

$stmt=$conn->prepare("SELECT * FROM Tbltype where TypeID=:typeid");
$stmt->bindParam(':typeid',$typeid);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $price=$row['Price'];
}

$quantity=$_POST['quantity'];

$stmt=$conn->prepare("SELECT * FROM TblOnlineorders WHERE OrderID=:orderid and TypeID=:typeid");//checks to see if there is already an item of the same type in the basket and 
//if there is it takes the quantity of it so that this can be altered and then updated
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->bindParam(':typeid',$typeid);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $q=$row['Quantity'];
    if ($q>0){
        $quantity=$q+$quantity;
}
}
if ($quantity>1){//checks if the quantity is greater than 1 as when this is the case the table needs to be updated
    $stmt=$conn->prepare("UPDATE Tblonlineorders SET Quantity=:quantity WHERE UniformID=:uniform");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam('uniform',$uniformid);
    $stmt->execute();
}


else{
    $stmt=$conn->prepare("INSERT INTO Tblonlineorders(OrderID,TypeID,Quantity) VALUES (:orderid,:typeid,:quantity)");
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->bindParam(':typeid',$typeid);
    $stmt->bindParam(':quantity',$quantity);
    $stmt->execute();
}


$stmt=$conn->prepare("SELECT * FROM Tblorders where OrderID=:orderid");//selects the rows of the table where the typeID is equal to the typID searched for
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $total=$row['Total'];
    }

$total=$total+$price;//adds the price to the total for the orders table

$stmt=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=:orderid");//updates the orders table to include the new total
$stmt->bindParam(':total', $total);
$stmt->bindParam('orderid',$_SESSION['orderid']);
$stmt->execute();










?> 


