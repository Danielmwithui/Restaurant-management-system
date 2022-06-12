<?php include('partials/menu.php');?>
<?php
//Check whether id i set or not
if(isset($_GET['id']))
{
    //Get the Details
    $id=$_GET['id'];
    //SQL query to get the selected food
    $sql2="SELECT *FROM tbl_food WHERE id=$id";
    //Execute the query
    $res2=mysqli_query($conn,$sql2);
    //Get the value based on the query executed
    $row2=mysqli_fetch_assoc($res2);
    //Get the individual values of the selectted food
    $tittle=$row2['tittle'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];
}
else
{
    //Redirect to manage food Page
    header('Location:'.SITEURL.'admin/manage-food.php');

}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update  Food </h1>
        <br><br>
         <form action="" method="POST" enctype="multipart/form-data">
             <table tbl-30>
             <tr>
    <td>
        Tittle:
    </td>
    <td>
        <input type="text" name="tittle" value="<?php echo $tittle?>" >
    </td>
</tr>

<tr>
    <td>
        Description:
    </td>
       <td>
           <textarea name="description" id="" cols="30" rows="5" value="<?php echo $description?>"></textarea>
       </td>
</tr>

<tr>
    <td>
        Price:
    </td>
    <td>
        <input type="number" name="price" value="<?php echo $price?>">
    </td>
</tr>

<tr>
    <td>
        Current Image:
    </td>
    <td>
       <?php
       if($current_image == "")
       {
           //Image not Available
           echo "<div class='error'>Image Not available</div>";
       }
       else
       {
           //Image Available
           ?>
           <img src="<?php echo SITEURL;?>images/Food/<?php echo $current_image;?> "width="90px" height="60px" >
           <?php
       }
       ?>
    </td>
</tr>
<tr>
    <td>Select New Image</td>
    <td>
        <input type="file" name="image">
    </td>
</tr>
<tr>
    <td>Category:</td>
    <td>
        <select name="category" >

        <?php
        //SQL query to Get Active categories
        $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
        //Execute the Query
        $res=mysqli_query($conn,$sql);
        //count the rows
        $count=mysqli_num_rows($res);
        //Check whether category available or nor
        if($count>0)
        {
            //Category Available
            while($row=mysqli_fetch_assoc($res))
            {
                $category_tittle=$row['title'];
                $category_id=$row['id'];

             //   echo "<option value='$category_id'>$category_tittle</option>";
             ?>
             <option <?php  if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_tittle;?></option>
             <?php
            }
        }
        else
        {
            //Category not  Available
            echo "<option value='0'>Category not Available.</option>";
        }
        ?>
          

    </td>
</tr>

<tr>
    <td>
        Featured:
    </td>
    <td>
        <input <?php  if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
        <input <?php if($featured==""){echo "checked";} ?> type="radio" name="featured" value="No">No
    </td>
</tr>

<tr>
    <td>
        Active:
    </td>
    <td>
        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
        <input <?php if($active=="No"){echo "checked";} ?>  type="radio" name="active" value="No">No
    </td>
</tr>

<tr>
    <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="current_image"  value="<?php echo $current_image;?>">

        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
    </td>
</tr>

                

             </table>
         </form>
<?php
//Check whether butto clicked
if(isset($_POST['submit']))
{
    //echo "Button clicked";
    //Get all the details from the form
    $id=$_POST['id'];
    $tittle=$_POST['tittle'];
   $description=$_POST['description'];
    $price=$_POST['price'];
    $current_image=$_POST['current_image'];
    $category=$_POST['category'];

    $featured=$_POST['featured'];
    $active=$_POST['active'];
    //Upload the Image if selected
    //Check whether upload button is clicked or not
    if(isset($_FILES['image']['name']))
    {
        //upload button clicked
        $image_name=$_FILES['image']['name'];//New image name

        //Check whether the file is available or not
        if($image_name!="")
        {
            //Image is available
            //A.Uploading new image

            //Rename the image
            $ext=end(explode('.',$image_name));
            $image_name="Food-Name-".rand(000,999).'.'.$ext;

            //Get the src and dst path
            $src_path=$_FILES['image']['tmp_name'];
            $dst_path="../images/Food/".$image_name;
            //upload the image
            $upload=move_uploaded_file($src_path,$dst_path);
            //Check whether the image is uploaded or not
            if($upload==false)
            {
                //Failed to upload
                $_SESSION['upload']="<div class='error'>Failed to upload new Image.</div>";
                header('Location:'.'admin/manage-food.php');
                //stop the process
                die();
            }
            //B.Remove current image if available
            if($current_image!="")
            {
                //Current image is available
                //Remove the image
                $remove_path="..images/Food/".$current_image;

                $remove=unlink($remove_path);

                //Check whether the image is removed or not
                if($remove==false)
                {
                    //Failed to remove current image
                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current  Image.</div>";
                    header('Location:'.'admin/manage-food.php');
                    //stop the process
                    die();
                }
            }
        }
        else
        {
            $image_name=$current_image;///Default image when image is not selected
        }
    }
    else
    {
        $image_name=$current_imagep;//Default image when button is not clicked
    }
   
    //Update the food in Database
    $sql3="UPDATE tbl_food SET
    tittle='$tittle',
    description='$description',
    price=$price,
    image_name='$image_name',
    category_id=$category,
    featured='$featured',
    active='$active'
    WHERE id=$id
     ";
     //Execute the query
     $res3=mysqli_query($conn,$sql3);
       //Check whether data inserted or not
    if($res3==true)
    {
         //4.Redirect with a message to Manage Food Page
        //Data inserted successfully
        $_SESSION['update']="<div class ='success'>Food updated successfully.</div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to insert data
        $_SESSION['update']="<div class ='error'>Failed to add Food.</div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }
    //Redirect to manage food page

}
?>
    </div>
</div>
<?php include('partials/footer.php');?>