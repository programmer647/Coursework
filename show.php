<!DOCTYPE HTML>

<html>


<body>

<!DOCTYPE html>
<body>

<nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="checkoutbarcode.php">Barcode checkout</a></li>
            <li class="active"><a href="showtotals.php">View totals</a></li>
            <li><a href="login.php">Login</a></li>

          </ul>
        </div>
      </nav>

        
</body>
        
</html>


<?php

include_once("connection.php");

//print_r($_POST);

$stmt=$conn->prepare("SELECT * from Tblorders where Datecompleted=:d");
$stmt->bindParam(":d",$_POST["date"]);
$stmt->execute();

$total=0;
$housetotals = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0);
//print_r($housetotals);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {
    $total=$total+$row['Total'];
    $stmt2=$conn->prepare("SELECT Tbluniform.HouseID as house, Tblbasket.Quantity as q, Tbltype.Price as p FROM Tblbasket
    INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
    INNER JOIN Tbltype on Tbluniform.TypeID=Tbltype.TypeID
    WHERE OrderID=:orderID");
    $stmt2->bindParam(":orderID",$row['OrderID']);
    $stmt2->execute();
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
    {
        $tot=$row['q']*$row['p'];;
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