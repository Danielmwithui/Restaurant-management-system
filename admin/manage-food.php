<?php include('partials/menu.php');?>
 <!-----Main-content section  Start------->
 <div class="main-content">
       <div class="wrapper">
              <h1>Manage Food</h1>
              <br><br>
            
<!-----------Button for Adding Food---------------->
              <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
              <br><br>
              <?php
              if(isset($_SESSION['add']))
              {
                     echo $_SESSION['add'];
                     unset($_SESSION['add']);
              }

              if(isset($_SESSION['delete']))
              {
                     echo $_SESSION['delete'];
                     unset($_SESSION['delete']);
              }

              if(isset($_SESSION['upload']))
              {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
              }
              if(isset($_SESSION['update']))
              {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
              }
              ?>
              
                   <br> 
              <table class="tbl-full">
                     <tr>
                            <th>S.N.</th>
                            <th>Tittle</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                     </tr>
                     <?php
                     //Create sql query to get all the food
                     $sql="SELECT * FROM tbl_food";
                     //Execute the query
                     $res=mysqli_query($conn,$sql);
                     //Count rows to check whether we have foods or not
                     $count=mysqli_num_rows($res);
                     //Create serial number variable aND SET default value as 1
                     $sn=1;
                     if($count>0)
                     {
                            //We have food in the database
                            //get the foods frm Db and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                   //Get the values from individual columns
                                   $id=$row['id'];
                                   $tittle=$row['tittle'];
                                   $price=$row['price'];
                                   $image_name=$row['image_name'];
                                   $featured=$row['featured'];
                                   $active=$row['active'];
                                   ?>
                      <tr>
                            <td><?php echo $sn++?></td>
                            <td><?php echo $tittle?></td>
                            <td>Ksh.<?php echo $price?></td>
                            <td>
                                   <?php
                                   //Check whether we have image or not
                                   if($image_name=="")
                                   {
                                          //We do not have image, Display error message
                                          echo "<div class='error'>Image Not Added</div>";
                                   }
                                   else
                                   {
                                          //Display the imaGE
                                          ?>
                                          <img src="<?php  echo SITEURL;?>images/Food/<?php  echo $image_name?>" width="90px" height="60px" >
                                          <?php
                                   }
                                    ?>
                            </td>
                            <td><?php echo $featured?></td>
                            <td><?php echo $active?></td>
                            <td>
                            <a href="<?php  echo SITEURL;?>admin/update-food.php?id=<?php echo $id?>" class="btn-secondary">Update Food</a>
                            <a href="<?php  echo SITEURL;?>admin/delete-food.php?id=<?php echo $id?> & image_name=<?php echo $image_name?>" class="btn-danger">Delete Food</a>
                            </td>
                     </tr>
                    

                                   <?php
                            }
                     }
                     else
                     {
                            //Food  not Added in the database
                            echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                     }
                     ?>
                   
              </table>
     </div>
     </div>
            <!-----Main-content section  End------->

<?php include('partials/footer.php');?>
            