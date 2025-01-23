<?php
session_start();
include_once("connection.php");
if ($_SESSION['role']==1){
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

<body>

<a href="showsaletotals.php">
   <button>View in Person Sale Totals</button>
</a>

<br>

<a href="showonlinetotals.php">
   <button>View Online Totals</button>
</a>

<br>

<a href="displaydata.php">
   <button>View Graphs</button>
</a>