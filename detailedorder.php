<?php

include_once("connection.php");
session_start();

$id=$_GET['id'];

$ordernums=[];


$stmt=$conn->prepare("SELECT tblitems.ItemID as i, Name as n, Size as s, Quantity as q FROM Tblonlineorders 
    INNER JOIN tblorders ON tblonlineorders.OrderID=tblorders.OrderID
    INNER JOIN tbltype ON tblonlineorders.TypeID=tbltype.TypeID
    INNER JOIN tblitems ON tbltype.ItemID=tblitems.ItemID
    WHERE tblonlineorders.OrderID=:orderid");
    $stmt->bindParam(':orderid',$id);
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $ordernums[$row['i']]["Name"]=$row['n'];
            $ordernums[$row['i']]["Size"]=$row['s'];
            $ordernums[$row['i']]["Quantity"]=$row['q'];
        }
    
?>

<form action="readycollect.php" method="POST">

<?php
$i=0;
foreach($ordernums as $x){
    for ($j=1; $j<=$x['Quantity'];$j++){
        echo($x['Name'].' '.$x['Size']);
        echo("<input type='number' name=$i>");
        echo("<br>");
        $i=$i+1;
    }
}

echo("<input type='hidden' value=$id name='orderid'>");

echo("<input type='submit' value='Submit'>");

?>

</form>



