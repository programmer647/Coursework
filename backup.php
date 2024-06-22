<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=backup.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	include_once ("connection.php");
 
	$output = "";
 
	$output .="
		<table>
			<thead>
				<tr>
					<th>Order ID</th>
					<th>UniformID</th>
					<th>Quantity</th>
					
				</tr>
			<tbody>
	";
 
	$stmt = $conn->prepare("SELECT * FROM Tblbasket");
    $stmt->execute();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
 
	$output .= "
				<tr>
					<td>".$row['OrderID']."</td>
					<td>".$row['UniformID']."</td>
					<td>".$row['Quantity']."</td>
					
				</tr>
	";
	}
 
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
 
 
?>