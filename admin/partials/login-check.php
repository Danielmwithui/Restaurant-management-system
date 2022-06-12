<?php
//Authorization control
//Check whether user is logged in or not
if(!isset($_SESSION['user']))//if the user session is not set
{
//User is not logged in
//Redirect to login page with a message
$_SESSION['no-login-message']="<div class='error txt-centre' >Please login to access the Admin Panel.</div>";
//Redirect the user
header('Location:'.SITEURL.'admin/login.php');   

}

?>