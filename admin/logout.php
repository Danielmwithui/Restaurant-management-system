<?php
//include constants.php for URL
include('../config/constants.php');
//Destroy the session 
session_destroy();//unset $_SESSION['user']
//Redirect to login page
header('Location:'.SITEURL.'admin/login.php');

?>