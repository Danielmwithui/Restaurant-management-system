<?php
//include contants page
include('../config/constants.php');
//Check 
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //Process to delete

    //Get id and image_name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //Remove the image if available
    //Check whether the image is available
    if($image_name!="")
    {
        //Image available
        //Get the image Path
        $path="../images/Food/".$image_name;
        //Remove image file from the folder

        $remove=unlink($path);
        //Check whether the image is removed or  not
        if($remove==false)
        {
            //Failed to remove image
            $_SERVER['upload']="<div>Failed to remove image file</div>";
            //redirect to manage food page
            header('Location:'.SITEURL.'admin/manage-food.php');
            //Stop the process of deleting food
            die();
        }
    }
    //Delete food from database
    $sql="DELETE FROM tbl_food WHERE id=$id";
    //Execute the query
$res=mysqli_query($conn,$sql);
//check whether the query executed 
if($res==true)
{
    //Food deleted
$_SESSION['delete']="<div class='success'>Food deleted successfully</div>";
header('Location:'.SITEURL.'admin/manage-food.php');
}
else
{
//Failed to delete food
$_SESSION['delete']="<div class='error'>Failed to delete food .Try again later</div>";
header('Location:'.SITEURL.'admin/manage-food.php');
}
    //Redirect to Manage Food page with success message
}
else
{
    //Redirect to Manage Food Page
    $_SESSION['delete']="<div class='error'>Unauthorised access</div>";
    header('Location:'.SITEURL.'admin/manage-food.php');
}

?>