<?php
session_start();//allows the page to access the session variables
include_once("connection.php");//connects the page to the database
if ($_SESSION['role']!=3){
    echo("<script>alert('You do not have permission to access this page');
    window.location.href = 'customerhome.php';</script>");
}

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>View orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="vieworders.php">View Orders</a></li>
            <li><a href="stock.php">Add Stock</a></li>
            <li><a href="generate.php">Generate Barcodes</a></li>
            <li><a href="checkout.php">Checkout System</a></li>
            <li><a href="users.php">Add Users</a></li>
            <li class="active"><a href="totals.php">View Totals</a></li>
            <li><a href="uniform.php">Edit/add uniform</a></li>
            <li><a href="emails.php">Send emails</a></li>
            <li><a href="publishnews.php">Publish News</a></li>
            <li><a href="manageaccounts.php">Manage Accounts</a></li>
            <li><a href="logout.php">Log out</a></li>

          </ul>
        </div>
      </nav>





<?php
$stmt=$conn->prepare("SELECT * FROM Tblhouse");//selects all of the details from the house table
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){//goes through each item in the table and puts an entry into the array table
  $housetotals[$row['HouseID']]=0;
}

$stmt=$conn->prepare("SELECT Tbluniform.HouseID as house, Tblbasket.Quantity as q, Tblbasket.New as n, Tbltype.Price as p FROM Tblbasket
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tbltype on Tbluniform.TypeID=Tbltype.TypeID
INNER JOIN Tblorders on Tblbasket.OrderID=Tblorders.OrderID
WHERE Tblorders.Online=1 AND Tblorders.Datecompleted>=:date");//selects all the information from the tables needed to calculate the 
$stmt->bindParam(":date",$_POST['date']);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  if ($row['n']==1){
    $housetotals[$row['house']]=$housetotals[$row['house']]+($row['q']*$row['p']*1.65);
  }
  else{
    $housetotals[$row['house']]=$housetotals[$row['house']]+($row['q']*$row['p']);
  }
}

echo("Total for sales since: ".$_POST['date']."<br>");

$stmt=$conn->prepare("SELECT Name, HouseID FROM Tblhouse");
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  echo($row['Name']." £".$housetotals[$row['HouseID']]);
  echo("<br>");
}

?>


