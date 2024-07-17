<?php
include_once("connection.php");
session_start();
        ;
 
        
?>

<!DOCTYPE HTML>

<html>
<body>
        
                
<form action="removeitem.php" method="post">
<select name="item">

<?php
        
$stmt=$conn->prepare("SELECT Tblbasket.BasketID, Tblbasket.UniformID, Tbltype.Name as name, Tblhouse.Name as house, Tbltype.Size1 as s, Tblbasket.New from Tblbasket 
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID
INNER JOIN Tblhouse on Tbluniform.HouseID=Tblhouse.HouseID
WHERE OrderID=:orderid
");
$stmt->bindParam(":orderid",$_SESSION['orderid']);
$stmt->execute();
        
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
 {
 
 	echo('<option value='.$row["BasketID"].'>'.$row["name"].', '.$row["house"].', '.$row["s"].', '.$row["New"]);
 }        
        
   
?>
</form> 
        
<input type="submit" value="Delete item">        
        
        
</body>
</html>
