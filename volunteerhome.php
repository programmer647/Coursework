<?php
session_start();//starts the session so that session variables can be accessed
?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"><!--links to the external style sheet-->

</head>
<body>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active"><a href="loggedouthome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="stock.php">Add Stock</a></li>
            <li><a href="generate.php">Generate Barcodes</a></li>
            <li><a href="checkout.php">Checkout System</a></li>
            <li><a href="vieworders.php">View Orders</a></li>
            <li><a href="account.php">My Account</a></li>

          </ul>
        </div>
      </nav>


</body>
</html>
