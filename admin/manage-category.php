<?php include('partials/menu.php');?>
 <!-----Main-content section  Start------->
 <div class="main-content">
       <div class="wrapper">
              <h1>Manage Category</h1>
              <br><br>

              <?php
if(isset($_SESSION['add']))
{
        echo $_SESSION['add'];
        unset($_SESSION['add']);
}

if(isset($_SESSION['remove']))
{
        echo $_SESSION['remove'];
        unset($_SESSION['remove']);
}
if(isset($_SESSION['delete']))
{
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
}

if(isset($_SESSION['update']))
{
        echo $_SESSION['update'];
        unset($_SESSION['update']);
}

if(isset($_SESSION['upload']))
{
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
}

if(isset($_SESSION['failed-remove']))
{
        echo $_SESSION['failed-remove'];
        unset($_SESSION['failed-remove']);
}
if(isset($_SESSION['no-category-found']))
{
        echo $_SESSION['no-category-found'];
        unset($_SESSION['no-category-found']);
}
?>
<br><br>
<!-----------Button for Adding  Category---------------->
  <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary" >Add Category</a>
<br> <br><br>
              <table class="tbl-full">
                     <tr>
                            <th>S.N.</th>
                            <th>Tittle</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                     </tr>
                     <?php
                     $sql="SELECT * FROM tbl_category";
                     //Execute the query
                     $res=mysqli_query($conn,$sql);
                     //Count rows 
                     $count=mysqli_num_rows($res);

                     //Create a serial number variable and assign value as 1
                     $sn=1;
                     //Check whether  we have data in the db or not
                     if($count>0)
                     { 
                            //We have data in the db
                            //Get the data and disPLAY
                      while($row=mysqli_fetch_assoc($res))
                             {
                                    $id=$row['id'];
                                    $tittle=$row['title'];
                                    $image_name=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];
                                    ?>
                     <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $tittle; ?></td>

                            <td>
                                   <?php 
                                   //Check whether image name available available or not
                                   if($image_name!="")
                             {
                                    //Display the image
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo$image_name;?>" width="90px" height="60px">
                                    <?php
                             }
                             else
                             { 
                                     //Display the message
                                     echo "<div class='error'>Image not added</div>";
                             }
                                   ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id?> " class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php  echo $image_name;?>" class="btn-danger">Delete Category</a>
                            </td>
                     </tr>

                                    <?php
                             }

                     }
                     else
                     {
                           //We do not have data
                           //Display the message inside table
                           ?>
                           <tr> 
                                  <td colspan="6">
                                         <div class="error">No Category Added.</div>
                                  </td>

                           </tr>

                           <?php
                     }

                     ?>
                    
                    
              </table>
     </div>
     </div>
            <!-----Main-content section  End------->

<?php include('partials/footer.php');?>
            