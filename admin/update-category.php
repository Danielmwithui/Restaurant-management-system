<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        //Check whether the id is set or not
        if(isset($_GET['id']))
        {
            //Get the id and all the other Details
           // echo "Getting the Data";
           $id=$_GET['id'];
           //Create sql query to get all other details
           $sql="SELECT * FROM tbl_category WHERE id=$id";
           //Execute the query
           $res=mysqli_query($conn,$sql);
           //count the rows to check whether the id is valid or not
           $count=mysqli_num_rows($res);

           if($count==1)
           {
               //Get all the data
               $row=mysqli_fetch_assoc($res);
               $title=$row['title'];
               $current_image=$row['image_name'];
               $featured=$row['featured'];
               $active=$row['active'];
           }
           else
           {
               //Redirect to manage category with a message
               $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
               header('Location:'.SITEURL.'admin/manage-category.php');
           }
        }
        else
        {
            //Redirect to Manage Category
            header('Location:'.SITEURL.'admin/manage-category.php');
        }
        ?>
<form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>
            <td>Tittle:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title?>">
            </td>
        </tr>
        <tr>
            <td>Current  Image</td>
            <td>
               <?php
                    if($current_image !="")
                         {
                             //Display the imag
                            ?>
                            <img src="<?php  echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="90px" height="60px" >
                            <?php
                         }
                         else
                         {
                             //Display Message
                            echo "<div class='error'>Image Not Added</div>";
                         }
               ?>
            </td>
        </tr>
        <tr>
            <td>New Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Featured:</td>
            <td>
                <input <?php  if($featured=="Yes") {echo "Checked";}  ?> type="radio" name="featured"  value="Yes">Yes
                <input <?php  if($featured=="No") {echo "Checked";}  ?> type="radio" name="featured"  value="No">No
            </td>
        </tr>
        <td>Active:</td>
            <td>
                <input <?php  if($active=="Yes") {echo "Checked";}  ?> type="radio" name="active"  value="Yes">Yes
                <input <?php  if($active=="No") {echo "Checked";}  ?> type="radio" name="active"  value="No">No
            </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </td>
        </tr>
        </table>
</form>
<?php
      if($_POST['submit'])
      { 
          //echo "Clicked";
          //1.Get all the value from the form
         $id= $_POST['id'];
          $title=$_POST['title'];
          $current_image=$_POST['current_image'];
          $featured=$_POST['featured'];
          $active=$_POST['active'];

          //Updating new image if selected
          //Check whether the image is selected or not
          if(isset($_FILES['image']['name']))
                {
                        //Get the image  Details
                        $image_name=$_FILES['image']['name'];
                        //Check whether the image is available or not
                        if($image_name!="")
                        {
                            //Image Available
                            //A .Upload the new image
                             //Auto -rename the image
                                                //Get the extension of the image(png,jpg,gif,etc)eg."Food1.jpg"
                                                $ext=end(explode('.',$image_name));

                                                //rename the image
                                                $image_name="Food_category_".rand(000,999).'.'.$ext;
                                                $src_path=$_FILES['image']['tmp_name'];
                                                $dst_path="../images/category/".$image_name;
                                                //Finally upload the image
                                                $upload=move_uploaded_file($src_path,$dst_path);
                                                //Check whether the image is uploaded or not
                                                //And if the image is not uploaded ,stop the process and redirect with error message
                                                if($upload==false)
                                                {
                                                        //set message
                                                        $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                                        //redirect to manage category page
                                                        header('location:'.SITEURL.'admin/add-category.php');
                                                        //Stop the process
                                                        die();
                                                }


                            //B.Remove the current image
                            if($current_image!="")
                            {
                                $remove_path="../images/category/".$current_image;
                                $remove=unlink($remove_path);
    
                                //Check whether the image is removed or not and if failed to removed  display message and stop the process
                                if($remove==false)
                                {
                                    //Failed to remove the image
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
                                       //redirect to manage category page
                                       header('location:'.SITEURL.'admin/manage-category.php');
                                       //Stop the process
                                       die();
                                }

                            }
        
                        }
                        else
                        {
                            $image_name=$current_image;
                        }
                }
                else
                    {
                        $image_name=$current_image;
                    }

          //Update the database
          $sql2="UPDATE tbl_category  SET
          title='$title',
          image_name='$image_name',
          featured='$featured',
          active='$active'
          WHERE id=$id
          ";
          //Execute the query
          $res2=mysqli_query($conn,$sql2);
          //Check whether executed  or not
          if($res2==true)
          {
              // Category Updated
              $_SESSION['update']="<div class='success'>Category updated Successfully</div>";
              header('Location:'.SITEURL.'admin/manage-category.php');

          }
          else
          {
              //Failed to update Category
              $_SESSION['update']="<div class='error'>Failed to update Category</div>";
              header('Location:'.SITEURL.'admin/manage-category.php');
          }
          //Redirect to Manage Category with a message



      }
?>
    </div>
</div>



<?php include('partials/footer.php');?>