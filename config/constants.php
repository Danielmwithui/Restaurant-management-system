<?php
//start session
session_start();
error_reporting(0);

//Create constants based on known  repeating values
define('SITEURL','http://localhost/food-order/');

$server="localhost";
$user="root";
$pass="";
$database="food-order";
$conn=mysqli_connect($server,$user,$pass,$database);
if (!$conn){
    die("<script>alert('Failed to connect to  database')</script>");
}
?>