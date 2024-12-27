<?php

include_once("connection.php");
session_start();

print_r($_POST);

$orderid=$_POST['orderid'];
unset($_POST['orderid']);

foreach($_POST as $x){
    echo($x);
    $stmt=$conn->prepare("SELECT Quantity from tblbasket where UniformID=:id");
    $stmt->bindParam(':id', $x);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($row==[]){//if nothing is returned then a new entry is created in the basket table
            echo("yes");
            $stmt=$conn->prepare("INSERT INTO Tblbasket(OrderID,UniformID,Quantity) VALUES (:orderid,:uniformid,1)");
            $stmt->bindParam(':orderid',$orderid);
            $stmt->bindParam(':uniformid',$x);
            $stmt->execute();
        }
        else{//if the item is already in the basket then the quantity is updated to add one
            $q=$row['Quantity']+1;
            $stmt=$conn->prepare("UPDATE Tblbasket SET Quantity=:quantity WHERE UniformID=:uniformid");
            $stmt->bindParam(':quantity', $q);
            $stmt->bindParam('uniformid',$x);
            $stmt->execute();
        }
    }

$stmt=$conn->prepare("UPDATE Tblorders SET Uniformready=1 WHERE OrderID=:orderid");
$stmt->bindParam(':orderid', $orderid);
$stmt->execute();

?>