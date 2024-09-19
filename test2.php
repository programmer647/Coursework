<?php
include_once("connection.php");//connects the page to the database
session_start();//starts the session so that session variables can be accessed

?>

<!DOCTYPE html>
<html>
        
<head>
    
    <title>Shop</title><!--sets the title of the page-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"/><!--links to the external style sheet-->

</head>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="loggedouthome.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li class="active"><a href="shop.php">Shop</a></li><!--sets the shop page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <li><a href="news.php">News</a></li>
            <li><a href="faqs.php">FAQs</a></li>
            <li><a href="uniformlists.php">Uniform Lists</a></li>
            <?php
            if (!isset($_SESSION['name'])){
                echo("<li><a href='login.php'>Login/Sign up</a></li>");
            }
            else{
                echo("<li><a href='account.php'>My Account</a></li>
                <li><a href='logout.php'>Log out</a></li>");
            }
            ?>

          </ul>
        </div>
      </nav>

      <body>


<div class="row">
    <div class="col-sm-2"></div>
    <div class="dropdown">
        <button id="filterBtn" class="btn" onclick="filterDrop()">Filter</button>
            <div id="filterDropdown">Hello</div>
        </div>

        </div>

<script>
    function filterDrop(){
        document.getElementByID("filterDropdown").style.display = "none";

    }

</script>

</body>

</html>