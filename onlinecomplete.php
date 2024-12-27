<?php
include_once("connection.php");
session_start();

$id=$_GET['id'];
$stmt=$conn->prepare("SELECT Deliveryoption FROM tblorders WHERE OrderID=:orderid");
$stmt->bindParam(':orderid',$id);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);

if ($row['Deliveryoption']==1){
    $stmt=$conn->prepare("SELECT AddressLine1, AddressLine2, Postcode FROM tblorders WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h3>Home delivery</h3>");
    echo("Address Line 1:".$row['AddressLine1']);
    echo("Address Line 2:".$row['AddressLine2']);
    echo("Postcode:".$row['Postcode']);
}

elseif($row['Deliveryoption']==2){
    $stmt=$conn->prepare("SELECT Email FROM tblorders WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h3>Collection</h3>");
    echo("Email Address:".$row['Email']);
}

elseif($row['Deliveryoption']==3){
    $stmt=$conn->prepare("SELECT Pupilname, Year, Tutor, House FROM tblorders WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h3>Delivery to boarding house</h3>");
    echo("Pupil name:".$row['Pupilname']);
    echo("Year:".$row['Year']);
    echo("Tutor:".$row['Tutor']);
    echo("House".$row['House']);

}


//1=home delivery, 2=collection, 3=boarding house

?>