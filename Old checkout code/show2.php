<?php

include_once("connection.php");

$stmt=$conn->prepare("SELECT * from Tblorders where Datecompleted=:d");
$stmt->bindParam(":d",$_POST["date"]);
$stmt->execute();

$total=0;

$housetotals = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {
    $total=$total+$row['Total'];
    $stmt2=$conn->prepare("SELECT Tbluniform.HouseID as house, Tblbasket.Quantity as q, Tblbasket.New as n, Tbltype.Price as p FROM Tblbasket
    INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
    INNER JOIN Tbltype on Tbluniform.TypeID=Tbltype.TypeID
    WHERE OrderID=:orderID");
    $stmt2->bindParam(":orderID",$row['OrderID']);
    $stmt2->execute();
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
    {
        if ($row['n']=="on"){
            echo("yes");
            $price=$row['p']*1.65;
        }
        else{
            $price=$row['p'];
        }
        echo($price);
        $tot=$row['q']*$price;
        //echo($tot);
        //echo("</br>");
        $housetotals[$row['house']]=$housetotals[$row['house']]+$tot;
        
        //echo($row['house']. $row['q']);
    }
    
 }

//print_r($housetotals);

 echo("The overall total for this sale was:");
 echo("</br>");
 echo("£".$total);
 echo("</br>");
 echo("</br>");
 
 echo("House totals:");
 echo("</br>");

 $stmt3=$conn->prepare("SELECT * FROM Tblhouse;");
 $stmt3->execute();
 while ($row = $stmt3->fetch(PDO::FETCH_ASSOC))
 {

     echo($row['Name']." £".$housetotals[$row['HouseID']]);
     echo("</br>");
 }

//go to basket table
//select items with the right orderid
//sort them by house
//add item to house total
//go to next orderid


//inner join with tbltype to get price

?>


</body>
</html>