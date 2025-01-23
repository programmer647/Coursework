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
    
    <title>Display graphs</title>
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
$housedatapoints = array();
$itemdatapoints=array();
$housetotals=array();
$itemtotals=array();

//selecting data for house pie chart

//selects all the houses then creates an array with them in
$stmt=$conn->prepare("SELECT * FROM Tblhouse");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $housetotals[$row['HouseID']]['Name']=$row['Name'];//sets the name of the house to the name retreived from the database
    $housetotals[$row['HouseID']]['Total']=0;//sets the total for that house to zero
}

//selects each type of item which has been sold so that the totals can be calculated
$stmt = $conn->prepare('SELECT tblhouse.HouseID, tblhouse.Name, tblbasket.Quantity, tblbasket.UniformID, tbltype.Price From Tblorders
INNER JOIN Tblbasket on Tblbasket.OrderID=tblorders.OrderID
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tblhouse on Tbluniform.HouseID=Tblhouse.HouseID
INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID
WHERE Tblorders.Completed=1');
$stmt->execute(); 
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $total=$row['Quantity']*$row['Price'];//calculates the total for each type of item
    $housetotals[$row['HouseID']]['Total']=$housetotals[$row['HouseID']]['Total']+$total;//adds the total for the item to the total for that house
}

foreach($housetotals as $x){//goes through each item in the house array
    array_push($housedatapoints, array("x"=> $x['Name'], "y"=> $x['Total']));//adds the name and total from the array to the datapoints for the chart
}

//selecting data for item pie chart

//selects all the items then creates an array with them in it
$stmt=$conn->prepare("SELECT ItemID, Name from Tblitems");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $itemtotals[$row['ItemID']]['Name']=$row['Name'];//sets the name of the item to the name retreived from the database
    $itemtotals[$row['ItemID']]['Total']=0;//sets the total for that item to zero
}

//selects the number of each item sold
$stmt=$conn->prepare("SELECT tbltype.ItemID, tblbasket.Quantity FROM Tblorders
INNER JOIN Tblbasket on Tblbasket.OrderID=tblorders.OrderID
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tbltype on tbltype.TypeID=tbluniform.TypeID 
WHERE Tblorders.Completed=1");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $itemtotals[$row['ItemID']]['Total']=$itemtotals[$row['ItemID']]['Total']+$row['Quantity'];//adds the items to the totals
}

foreach($itemtotals as $x){//goes through each item in the house array
    array_push($itemdatapoints, array("y"=> $x['Total'], "label"=> $x['Name']));//adds the name and total from the array to the datapoints for the chart
}

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("housetotals", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Totals by house"
	},
	data: [{
		type: "pie", //change type to bar, line, area, pie, etc  
        indexLabel: "{x}",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{x}",
		dataPoints: <?php echo json_encode($housedatapoints, JSON_NUMERIC_CHECK); ?>

	}]
});
chart.render();

var chart = new CanvasJS.Chart("itemtotals", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Totals by item"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($itemdatapoints, JSON_NUMERIC_CHECK); ?>
    }]

});
chart.render();
 
}
</script>
</head>
<body>
<div id="housetotals" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<div id="itemtotals" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>    



