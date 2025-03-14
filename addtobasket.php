<?php
//starts the session and connects to the database
session_start();
include_once("connection.php");

header("Location:checkoutbarcode.php");

print_r($_POST);

$date = date('Y-m-d');//gets the current date

if (!isset($_SESSION['orderid']))//checks if the OrderID session variable is already set
{//if the OrderID session variable isn't set a new order is inserted into the table
    $stmt=$conn->prepare("INSERT INTO Tblorders(UserID,Datecreated,Datecompleted,Online) Values(:userid,:datecreated,:datecompleted,0)");
    $stmt->bindParam(':userid',$_SESSION['id']);
    $stmt->bindParam(':datecreated',$date);
    $stmt->bindParam(':datecompleted',$date);
    $stmt->execute();
    
    //selects the highest OrderID in the table and sets it as the OrderID session variable
    $stmt=$conn->prepare("SELECT MAX(OrderID) from Tblorders");
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];
    }
}

$uniformid=$_POST['barcode'];//sets the variable UniformID to the barcode which has been scanned
if (isset($_POST['new'])){//checks if the new button has been selected on the page and if it has sets the variable to 1
    $new=$_POST['new'];

}
else{//if the new button wasn't selected it sets the new variable to 0
    $new=0;
}

$quantity=1;//sets the quantity to one as only 1 item is scanned at once

$stmt=$conn->prepare("SELECT * FROM Tblbasket WHERE OrderID=:orderid and UniformID=:uniform and New=:new");//checks to see if there is already an item of the same type in the basket and 
//if there is it takes the quantity of it so that this can be altered and then updated
$stmt->bindParam(':orderid',$_SESSION['orderid']);
$stmt->bindParam(':uniform',$uniformid);
$stmt->bindParam(':new',$new);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $q=$row['Quantity'];
    if ($q>0){
        $quantity=$q+1;
    }
}

if ($quantity>1){//checks if the quantity is greater than 1 as when this is the case the table needs to be updated
    $stmt=$conn->prepare("UPDATE Tblbasket SET Quantity=:quantity WHERE UniformID=:uniform and New=:new and OrderID=:orderid");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->bindParam(':uniform',$uniformid);
    $stmt->bindParam(':new',$new);
    $stmt->execute();
}

else{//because there is not already an item of the same type in the basket the 
    $stmt=$conn->prepare("INSERT INTO Tblbasket(OrderID,UniformID,Quantity,New) VALUES (:orderid,:uniformid,:quantity,:new)");
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->bindParam(':uniformid',$uniformid);
    $stmt->bindParam(':quantity',$quantity);
    $stmt->bindParam('new',$new);
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
$tot=$row['Total'];//sets a variable for the order total
if ($new==1){//checks if the item is new or not
    $total=$tot+($price*1.65);//if the item is new the price added to the total is multiplied by 1.65 as this is the amount that new items are increased by 
}
else{
    $total=$tot+$price;//if the item isn't new the normal price is added to the total
}

//statement to update the total in the table
$stmt=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=:orderid");
$stmt->bindParam(":total",$total);
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();

//statement to retrieve how many of the item are left in stock
$stmt=$conn->prepare("SELECT Stock FROM Tbluniform WHERE UniformID=:uniformid");
$stmt->bindParam(":uniformid",$uniformid);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$itemquantity=$row['Stock'];//sets the variable itemquantity equal to the stock

$itemquantity=$itemquantity-1;//subtracts one from the number of the item in stock

//updates the uniform table with the new stock level
$stmt=$conn->prepare("UPDATE Tbluniform SET Stock=:Stock WHERE UniformID=:uniformid");
$stmt->bindParam(":Stock",$itemquantity);
$stmt->bindParam(":uniformid",$uniformid);
$stmt->execute();


?>




