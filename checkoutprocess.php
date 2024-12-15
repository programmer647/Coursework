<?php
include_once("connection.php");
session_start();

print_r($_SESSION);

print_r($_POST);

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
    
}

elseif($method="boarding"){
    ?>
    <form action="checkoutprocess.php" method="POST">
        Pupil name:<input type="text" name="name"><br>
        Pupil year group:<input type="text" name="year"><br>
        Pupil's tutor:<input type="text" name="tutor"><br>
        Boarding house:<input type="text" name="house"><br>
    <?php
}