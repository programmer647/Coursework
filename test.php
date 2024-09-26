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
        <button id="sortBtn" class="btn dropbtn" onclick="sortDrop()">Sort</button>
        <div id="sortDropdown" class="dropdown-content">
            <form action="sortfilter.php" method="POST" id="sortForm" style="padding: 10%;">
                <div class="text-center">
                    <input id="order-asc" type="radio" value="ASC" name="order" required>
                    <label id="order-asc" for="order-asc">Ascending
                    </label>
                    <input id="order-des" type="radio" value="DES" name="order" required>
                    <label id="order-des" for="order-des">Descending
                    </label>
                </div>
                <hr class="solid1">
                <input id="price" type="radio" value="itemprice" name="sort" required>
                <label for="price">Price</label><br>
                <input id="name" type="radio" value="itemname" name="sort">
                <lable for="name">Name</label>
                <input type="hidden" name="type" value='sort'>
                <input type="hidden" name="filter" value=<?php if(isset($category)){echo($category);}else{echo('none');}?>>
                <br><div class="text-center"><input type="submit" value="Apply" class="btn btn-lg"></div>
            </form>
        </div>
    </div>
</div>





<div class="container-fluid">
<?php
$stmt=$conn->prepare("SELECT * FROM Tblitems");//selects all the details of every item in the table
$stmt->execute();

$c=0;//variable that stores the number of columns that have been created. When it hits 6 which is the maximum it goes back to zero 
//which starts a new row

while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if ($c==0){
        echo('<div class=row>');//creates a new row if the maximum number of columns for the previous one has been reached
    }
    echo('<div class="col-sm-2">');//creates a column which is the correct width for there to be 6 on the page
    $photo=$row['Photo'];
    echo("<a href=detaileduniform.php?id=".$row['ItemID']."><img src=$photo class='shop'></a>");//prints the photo of the item which has been retreived from the database. This 
    //photo also acts as a link to take the user to the page with more details
    echo("<center><h4>".$row['Name']."</h4></center>");//prints the name of the item underneath the photo
    echo('</div>');//ends the div allowing another item to be created
    $c=$c+1;//adds one to the column value
    if ($c==6){//checks if the maximum number of columns has been reached
        echo('</div>');//ends the current row if the max number of columns has been reached
    }
}

?>

</div>


<script>
    function sortDrop(){
        document.getElementById("sortDropdown").classList.toggle("show");
    }

</script>


</body>
</html>
