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
    echo("<br>");
    echo("Address Line 2:".$row['AddressLine2']);
    echo("<br>");
    echo("Postcode:".$row['Postcode']);
    echo("<br>");
}

elseif($row['Deliveryoption']==2){
    $stmt=$conn->prepare("SELECT Email FROM tblorders WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h3>Collection</h3>");
    echo("Email Address:".$row['Email']);
    echo("<br>");
}

elseif($row['Deliveryoption']==3){
    $stmt=$conn->prepare("SELECT Pupilname, Year, Tutor, House FROM tblorders WHERE OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h3>Delivery to boarding house</h3>");
    echo("Pupil name:".$row['Pupilname']);
    echo("Year:".$row['Year']);
    echo("<br>");
    echo("Tutor:".$row['Tutor']);
    echo("<br>");
    echo("House".$row['House']);
    echo("<br>");
}

echo("<a href='finalonlinecomplete.php?id=".$id."'>");
echo("<button type='button'>Mark order as completed");
echo("</button>");
echo("</a>");

?>




