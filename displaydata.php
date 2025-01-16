<?php
session_start();
include_once("connection.php");
 
$housedatapoints = array();
$itemdatapoints=array();
$housetotals=array();

//selects all 
$stmt=$conn->prepare("SELECT * FROM Tblhouse");
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $housetotals[$row['HouseID']]['Name']=$row['Name'];
    $housetotals[$row['HouseID']]['Total']=0;
}

$stmt = $conn->prepare('SELECT tblhouse.HouseID, tblhouse.Name, tblbasket.Quantity, tblbasket.UniformID, tbltype.Price From Tblorders
INNER JOIN Tblbasket on Tblbasket.OrderID=tblorders.OrderID
INNER JOIN Tbluniform on Tblbasket.UniformID=Tbluniform.UniformID
INNER JOIN Tblhouse on Tbluniform.HouseID=Tblhouse.HouseID
INNER JOIN Tbltype on Tbltype.TypeID=Tbluniform.TypeID
WHERE Tblorders.Completed=1');
$stmt->execute(); 
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $total=$row['Quantity']*$row['Price'];
    $housetotals[$row['HouseID']]['Total']=$housetotals[$row['HouseID']]['Total']+$total;
}
$link = null;

foreach($housetotals as $x){
    array_push($housedatapoints, array("x"=> $x['Name'], "y"=> $x['Total']));
}


$stmt=$conn->prepare("SELECT ")












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

var chart = new CanvasJS.Chart("items", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Totals by house"
	},
	data: [{
		type: "bar", //change type to bar, line, area, pie, etc  
        indexLabel: "{x}",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 18,
		indexLabelFontWeight: "bolder",
		showInLegend: true,
		legendText: "{x}",
		dataPoints: <?php echo json_encode($itemdatapoints, JSON_NUMERIC_CHECK); ?>
    }]

});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>    
