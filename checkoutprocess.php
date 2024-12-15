<?php
include_once("connection.php");
session_start();


$method=$_SESSION['method'];

if ($method=="home"){
    $stmt=$conn->prepare("UPDATE Tblorders SET AddressLine1=:address1, AddressLine2=:address2, Postcode=:postcode WHERE OrderID=:orderid");
    $stmt->bindParam(':address1', $_POST['addressline1']);
    $stmt->bindParam(':address2',$_POST['addressline2']);
    $stmt->bindParam(':postcode',$_POST['postcode']);
    $stmt->bindParam(':orderid',$_SESSION['orderid']);
    $stmt->execute();
}

elseif ($method=="collect"){
    echo('yes');
    $stmt=$conn->prepare("UPDATE Tblorders SET Email=:email WHERE OrderID=:orderid");
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':orderid', $_SESSION['orderid']);
    $stmt->execute();
}

elseif($method="boarding"){
    $stmt=$conn->prepare("UPDATE Tblorders SET Pupilname=:name, Year=:year, Tutor=:Tutor, House=:house WHERE OrderID=:orderid");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':year',$_POST['year']);
    $stmt->bindParam(':tutor',$_POST['tutor']);
    $stmt->bindParam(':house',$_POST['house']);
    $stmt->bindParam(':orderid', $_SESSION['orderid']);
    $stmt->execute();
}


unset($_SESSION['orderid']);
unset($_SESSION['method']);

print_r($_SESSION);

?>
