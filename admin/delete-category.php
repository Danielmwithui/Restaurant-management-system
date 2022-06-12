<?php 

//Include constants file
include('../config/constants.php');
//Check whether the id and image name value is set or not
if(isset($_GET['id']) AND  isset($_GET['image_name']))
                 {
                     //Get the value and Delete
                    // echo "Get value and Delete";
                   $id=$_GET['id'];
                   $image_name=$_GET['image_name'];
                   //Remove the image file if available
                   if($image_name!="")
                   {
                       //Image is available so remove it
                       $path="../images/category/".$image_name;
                       //Remove the image
                       $remove= unlink($path);
                       //If failed to remove image then add an error message  and stop the process
                       if($remove==false)
                       {
                          //set the session message
                          $_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
                          //Redirect to Manage Category
                          header('Location:'.SITEURL.'admin/manage-category.php');
                          //Stop the process
                          die();
                       }
                   }
                   //Delete data from Db
                     //sql query to delete data from db
                   $sql="DELETE FROM tbl_category WHERE id=$id";

                   //Execute the query
                   $res=mysqli_query($conn,$sql);

                   //Check whether the data is deleted from the database
                   if($res==true)
                   {
                       //Set success message and Redirect
                       $_SESSION['delete']="<div  class='success'>Category Deleted Successfully</div>";
                       //Redirect to Manage Category
                       header('Location:'.SITEURL.'admin/manage-category.php');

                   }
                   else
                   {
                       //Set Fail message and Redirect
                       $_SESSION['delete']="<div  class='error'>Failed to Delete Category</div>";
                       //Redirect to Manage Category
                       header('Location:'.SITEURL.'admin/manage-category.php');
                   }
                
                 }
                 else
                 {
                     //Redirect to manage Category page
                     header('Location:'.SITEURL.'admin/manage-category.php');
                 }
?>


