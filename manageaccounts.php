<?php
session_start();
include_once("connection.php");
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
$stmt=$conn->prepare("SELECT UserID, Forename, Surname, Username, Role FROM Tblusers");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo("<a href='editaccountdetails.php?id=".$row['UserID']."'>");
    echo("<button>");
    echo("Edit account");
    echo("</button>");
    echo("</a>");
    if ($row['Role']==1){
        $role="Customer";
    }
    elseif ($row['Role']==2){
        $role="Volunteer";
    }
    elseif ($row['Role']==3){
        $role="Commitee Member";
    }
    echo($row['Forename'].', '.$row['Surname'].', '.$row['Username'].', '.$role);
    echo("<br>");
  }


?>