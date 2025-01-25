<?php
session_start();//starts the session so that session variables can be accessed
if (!isset($_SESSION['name']))
{   
    header("Location:loggedouthome.php");
}
elseif ($_SESSION['role']==1) {
    header("Location:customerhome.php");
}
elseif ($_SESSION['role']==3) {
    header("Location:adminhome.php");
}

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"><!--links to the external style sheet-->

</head>


<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active"><a href="loggedouthome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="stock.php">Add Stock</a></li>
            <li><a href="generate.php">Generate Barcodes</a></li>
            <li><a href="checkoutbarcode.php">Checkout System</a></li>
            <li><a href="vieworders.php">View Orders</a></li>
            <!-- <li><a href="account.php">My Account</a></li> -->
            <li><a href="logout.php">Log Out</a></li>

          </ul>
        </div>
      </nav>

<body>


<div class="box box-centre">
<h1>
<?php
echo("Hello ".$_SESSION['firstname']);
?>  
</h1>

<h3>Welcome back to the pre-loved uniform shop</h3>
</div>

<div class="container">
<div class="box box-centre mx-auto">
  <h3>What would you like to do?</h3>
  <p><a href="stock.php">Add stock</a></br>
  <a href="generate.php">Generate barcodes</a></br>
  <a href="checkoutbarcode.php">Use the checkout system</a></br>
  <a href="vieworders.php">View pending orders</a></br>
  <!-- <a href="account.php">Manage your account</a> -->
</p>
</div>
</div> 

<div class="container-fluid box">
<h3 align="center">Upcoming Sales</h3>
    <p>Example: xx/xx/xx</br>
    Example: xx/xx/xx </p>

</div>

</body>
</html>
