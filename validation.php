<?php
//logged in user


//volunteer


//committee member
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