<?php
session_start();//starts the session so that session variables can be accessed

//these if statements ensure that only committee members can access this home page
if (!isset($_SESSION['name']))//checks if the user is logged in 
{   //if the user isn't logged in they are redirected back to the logged out home page
    header("Location:loggedouthome.php");
}
elseif ($_SESSION['role']==1) {//if the user is logged in as a customer they are redirected to the customer home page
    header("Location:customerhome.php");
}
elseif ($_SESSION['role']==2) {//if the user is a volunteer they are redirected to the volunteer home page
    header("Location:volunteerhome.php");
}

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Home Page</title><!--sets the title of the page-->
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
            <li><a href="vieworders.php">View Orders</a></li>
            <li><a href="stock.php">Add Stock</a></li>
            <!-- <li><a href="generate.php">Generate Barcodes</a></li> -->
            <li><a href="checkoutbarcode.php">Checkout System</a></li>
            <li><a href="users.php">Add Users</a></li>
            <li><a href="totals.php">View Totals</a></li>
            <!-- <li><a href="uniform.php">Edit/add uniform</a></li> -->
            <!-- <li><a href="emails.php">Send emails</a></li> -->
            <!-- <li><a href="publishnews.php">Publish News</a></li> -->
            <li><a href="manageaccounts.php">Manage Accounts</a></li>
            <li><a href="logout.php">Log out</a></li>

          </ul>
        </div>
      </nav>

<body>


<div class="box box-centre">
<h1>
<?php
echo("Hello ".$_SESSION['firstname']);//prints a message saying hello to the user who is logged in along with their name which is retrieved from the session variable set when they log in 
?>  
</h1>

<h3>Welcome back to the pre-loved uniform shop</h3>
</div>

<div class="container">
<div class="box box-centre mx-auto">
  <h3>What would you like to do?</h3>
  <!--provides links to the various functions that committee members are able to perform using the system-->
  <p><a href="vieworders.php">View pending orders</a></br>
    <a href="stock.php">Add stock</a></br>
  <!-- <a href="generate.php">Generate barcodes</a></br> -->
  <a href="checkoutbarcode.php">Use the checkout system</a></br>
  <a href="users.php">Add users</a></br>
  <a href="totals.php">View totals</a></br>
  <!-- <a href="uniform.php">Edit/add uniform</a></br> -->
  <!-- <a href="emails.php">Send an email to the email list</a></br> -->
  <!-- <a href="publishnews.php">Publish news</a></br> -->
  <a href="account.php">Manage accounts</a>
</p>
</div>
</div> 

<div class="container-fluid"><!--creates a seperate container for the next part of the page-->
<div class="row">
<div class="col-sm-6 box">
<h3 align="center">Sale Totals</h3>
</div>
<div class="col-sm-6 box">
<h3 align="center">Upcoming Sales</h3>
    <p>Example: xx/xx/xx</br>
    Example: xx/xx/xx </p>
</div>
</div>
</div>

</body>
</html>
