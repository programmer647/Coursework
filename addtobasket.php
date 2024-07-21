<?php
session_start();
?>


<?php
include("connection.php");

//code to get uniformid from table using manually entered data


//session_start();
print_r($_SESSION);
print_r($_POST);
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
    
    $stmt=$conn->prepare("SELECT MAX(OrderID) from Tblorders");//selects the largest OrderID from the table which will be the order which has 
    //just been created because the OrderID is autoincrement 
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $_SESSION['orderid']=$row['MAX(OrderID)'];//sets the session orderid to the new one which has been created
    echo($_SESSION['orderid']);//prints the new orderid so that I can check that the code is working (this will be removed later)
    }
}

$uniformid=$_POST['barcode'];//retrieves the barcode entered on the previous page and sets a variable for it
echo($uniformid);

$stmt=$conn->prepare("SELECT * FROM Tbluniform where UniformID=$uniformid");//selects the item where the uniformID is the one that was 
//represented by the barcde
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $type=$row['TypeID'];//sets the type of the uniform to the variable. This is needed to check the price of the item and to get the name of it
    }

$stmt=$conn->prepare("SELECT * FROM Tbltype where TypeID=:type");//selects the rows of the table where the typeID is equal to the typID searched for
$stmt->bindParam(':type',$type);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    $price=$row['Price'];
    $name=$row['Name'];
    $size=$row['Size1'];
    $size=$row['Size2'];
    }


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




