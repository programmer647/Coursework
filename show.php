<?php
include_once("connection.php");//connects the page to the database

$stmt=$conn->prepare("SELECT * FROM Tblhouse");//selects all of the details from the house table
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){//goes through each item in the table and puts an entry into the array table
  $housetotals[$row['HouseID']]=0;
}


$stmt=$conn->prepare("SELECT Tbluniform.HouseID as house, Tblbasket.Quantity as q, Tblbasket.New as n, Tbltype.Price as p FROM Tblbasket
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tbltype on Tbluniform.TypeID=Tbltype.TypeID
INNER JOIN Tblorders on Tblbasket.OrderID=Tblorders.OrderID
WHERE Tblorders.Online=0 AND Tblorders.Datecompleted=:date");//selects all the information from the tables needed to calculate the 
$stmt->bindParam(":date",$_POST['date']);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  if ($row['n']=1){
    $housetotals[$row['house']]=$housetotals[$row['house']]+($row['q']*$row['p']*1.65);
  }
  else{
    $housetotals[$row['house']]=$housetotals[$row['house']]+($row['q']*$row['p']);
  }
}

echo("Total for sales on: ".$_POST['date']."<br>");

$stmt=$conn->prepare("SELECT Name, HouseID FROM Tblhouse");
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  echo($row['Name']." £".$housetotals[$row['HouseID']]);
  echo("<br>");
}

?>


