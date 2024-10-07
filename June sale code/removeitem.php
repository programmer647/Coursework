<?php
include_once("connection.php");
session_start();





    $stmt2=$conn->prepare("SELECT Tbltype.Price, Tblbasket.New, Tblbasket.Quantity, Tblorders.Total FROM Tblbasket 
    INNER JOIN Tbluniform on Tbluniform.UniformID=Tblbasket.UniformID
    INNER JOIN Tbltype on Tbluniform.TypeID=Tbltype.TypeID
    INNER JOIN Tblorders on Tblbasket.OrderID=Tblorders.OrderID
    WHERE BasketID=:basketid");
	$stmt2->bindParam(":basketid",$_POST['item']);
	$stmt2->execute();
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC))
          {
           // print_r($row);
            if ($row['New']=="on"){
                    $price=$row['Price']*1.65;
                            }
            else{
                    $price=$row['Price'];
                    }
            $total=$row['Total']-($price*$row['Quantity']);
            //echo($total);
            $stmt3=$conn->prepare("UPDATE Tblorders SET Total=:total WHERE OrderID=:orderid");
            $stmt3->bindParam(":total",$total);
            $stmt3->bindParam(":orderid",$_SESSION['orderid']);
			$stmt3->execute();
            
           }
        
  





$stmt=$conn->prepare("DELETE FROM Tblbasket WHERE BasketID=:basketid");
$stmt->bindParam(":basketid",$_POST['item']);
$stmt->execute();

echo("Item removed")

?>


<!DOCTYPE HTML>

<html>
        
        <body>
        
                
                <form action="checkoutbarcode.php">
                        <input type="submit" value="Return to checkout">
        
        
        </body>
        


</html>