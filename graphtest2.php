<?php
 
$dataPoints = array();

include_once("connection.php");

//Best practice is to create a separate file for handling connection to database
	
    $handle = $conn->prepare('SELECT UserID, Forename From tblusers'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->Forename, "y"=> $row->UserID));
    }
	$link = null;
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Test chart"
	},
	data: [{
		type: "pie", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
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



