<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>Add Food</h1>

<br><br>
<?php
if(isset(  $_SESSION['upload']))
echo   $_SESSION['upload'];
unset(  $_SESSION['upload']);

?>
<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
<tr>
    <td>
        Tittle:
    </td>
    <td>
        <input type="text" name="tittle" placeholder="Tittle of the Food">
    </td>
</tr>

<tr>
    <td>
        Description:
    </td>
       <td>
           <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
       </td>
</tr>

<tr>
    <td>
        Price:
    </td>
    <td>
        <input type="number" name="price">
    </td>
</tr>

<tr>
    <td>
        Select Image:
    </td>
    <td>
        <input type="file" name="image">
    </td>
</tr>

<tr>
    <td>
        Category:
    </td>
    <td>
<select name="category" >
<?php
//Create php code to display categories from database

//1.create sql to get all active categories from database
$sql="SELECT * FROM tbl_category WHERE active='Yes' ";
//Executing the query
$res=mysqli_query($conn,$sql);
//Count rows to check we have categories or not
$count=mysqli_num_rows($res);
//If count greater  than 0 else no categories
if($count>0)
{
//We have categories
while($row=mysqli_fetch_assoc($res))
{
    //Get all details of category
    $id=$row['id'];
    $title=$row['title'];
    //Display in a dropdown
    ?>
    <option value="<?php  echo $id;?>"><?php  echo $title?></option>

    <?php
}
}
else
{
    //We do not have categories
    ?>
     <option value="0">No categories Found</option>
    <?php
}

?>


   
</select>
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
        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
    </td>
</tr>
    </table>
</form>
<?php
//Check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Clicked";
    //1.Get  the data from the form
$tittle=$_POST['tittle'];
$description=$_POST['description'];
$price=$_POST['price'];
$category=$_POST['category'];

//Check whether radio button for featured and active are  checked or not

if(isset($_POST['featured']))
{
    $featured=$_POST['featured'];
}
else
{
$featured="No";//Setting the default value
}


if(isset($_POST['active']))
{
    $active=$_POST['active'];
}
else
{
$active="No";//Setting the default value
}
    //2.Upload the image if selected
        //Check whether  the select image is clicked or not and upload the image only when the image is selected
        if(isset($_FILES['image']['name']))
        {
            //Get the Details of the selected image
            $image_name=$_FILES['image']['name'];
                    //Upload image only if image is selected
                    if($image_name!="")
                    {
                                  //Auto -rename the image
                                  //Get the extension of the image(png,jpg,gif,etc)eg."Food1.jpg"
                                  $ext=end(explode('.',$image_name));

                                  //rename the image
                                  $image_name="Food_name_".rand(000,999).'.'.$ext;
                                  $src_path=$_FILES['image']['tmp_name'];
                                  $dst_path="../images/Food/".$image_name;
                                  //Finally upload the image
                                  $upload=move_uploaded_file($src_path,$dst_path);
                                  //Check whether the image is uploaded or not
                                  //And if the image is not uploaded ,stop the process and redirect with error message
                                  if($upload==false)
                                  {
                                          //set message
                                          $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                          //redirect to manage category page
                                          header('location:'.SITEURL.'admin/add-food.php');
                                          //Stop the process
                                          die();
                                  }

                    }


             
        
        }
        else
        {
            $image_name="";///Setting default as blank
        }



    //3.Insert the data into the database
    //Create sql query
    $sql2="INSERT INTO tbl_food SET 
    tittle='$tittle',
    description='$description',
    price=$price,
    image_name='$image_name',
    category_id=$category,
    featured='$featured',
    active='$active'
    ";
    //Execute the query
    $res2=mysqli_query($conn,$sql2);
    //Check whether data inserted or not
    if($res2==true)
    {
         //4.Redirect with a message to Manage Food Page
        //Data inserted successfully
        $_SESSION['add']="<div class ='success'>Food added successfully.</div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to insert data
        $_SESSION['add']="<div class ='error'>Failed to add Food.</div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }


   
}
?>
</div>
</div>

<?php include('partials/footer.php');?>