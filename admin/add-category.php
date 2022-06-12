<?php include('partials/menu.php');?>

 <!-----Main-content section  Start------->
 <div class="main-content">
       <div class="wrapper">
              <h1>Add Category</h1>
              <br><br><br>
<?php
if(isset($_SESSION['add']))
{
        echo $_SESSION['add'];
        unset($_SESSION['add']);
}
if(isset($_SESSION['upload']))
{
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
}
?>
<br><br>

      <!------Add category form------->
<form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
                <tr>
                        <td>
                                Tittle:
                        </td>
                        <td>
                                <input type="text" name="title" placeholder="Category-title" required>
                        </td>
                </tr>
                  <tr>
                          <td>
                        Select image:
                          </td>
                          <td>
                                  <input type="file" name="image" >
                          </td>
                  </tr>
                <tr>
                        <td>
                                Featured:
                        </td>
                        <td>
                                <input type="radio" name="featured" value="Yes">Yes
                                <input type="radio" name="featured" value="No">No
                        </td>
                </tr>

                <tr>
                        <td>
                                Active:
                        </td>
                        <td>
                                <input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                        </td>
                </tr>
                <tr>
                        <td colspan="2">
                                 <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                </tr>
        </table>
</form>
                <!--Add Form Category ends-->

                <?php
                //Check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                       // echo "CLICKED";
                
                        //1.Get the value from form
                        $title=$_POST['title'];
                        //For radio input ,we need to check whether the button is selected or not
                        if(isset($_POST['featured']))
                        {
                                //Get the value from form
                                $featured=$_POST['featured'];
                        }
                        else 
                        {
                                //Set  the default value
                                $featured="No";
                        }

                        if(isset($_POST['active']))
                        {
                                //Get the value from form
                                $active=$_POST['active'];
                        }
                        else 
                        {
                                //Set  the default value
                                $featured="No";
                        }
                        //Check whether the image is selected or not and set the value of the image name accordingly
                        //print_r($_FILES['image']);
                        //die();//Break the code here

                        if(isset($_FILES['image']['name']))
                        {
                                //Upload the image
                                //To upload the image we need image_name ,src path and dest path
                                $image_name=$_FILES['image']['name'];
                                  //Upload image only if image is selected
                                  if($image_name!="")
                                  {
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

                                  }

                            
                        }
                        else
                        {
                                //Don't upload the image and set the image_name as blank
                                $image_name="";
                        }

                        //2.Create sql  query to insert category in the database
                        $sql="INSERT INTO  tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                        ";
                        //3.Execute the query and save in the database
                        $res=mysqli_query($conn,$sql);
                        //4.Check  whether the query is executed successfully or not
                        if($res==true)
                        {
                                //Query executed and category added successfully
                                $_SESSION['add']="<div class='success'>Category added successfully.</div>";
                                //redirect to manage category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                        }
                        else
                        {
                                //Failed to add category
                                $_SESSION['add']="<div class='error'>Failed to add category.</div>";
                                //redirect to manage category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                        }

                 }

                ?>


                
 
        </div>
        </div>


<?php include('partials/footer.php');?>