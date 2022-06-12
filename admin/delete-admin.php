<?php
//include constants.php
include('../config/constants.php');
//1.Get id of admin to be deleted
 $id=$_GET['id'];
//2.Create SQL query to Delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//Execute the query
$res=mysqli_query($conn,$sql);
//check whether the query executed 
if($res==true)
{
//Admin deleted
//echo "Admin deleted";
$_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
header('Location:'.SITEURL.'admin/manage-admin.php');
}else
{
//echo "Failed to Delete Admin";
//create a session variable to display message
$_SESSION['delete']="<div class='error'>Failed to delete admin .Try again later</div>";
header('Location:'.SITEURL.'admin/manage-admin.php');
}
//3.Redirect to manage-admin


?>