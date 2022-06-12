<?php include('partials/menu.php');?>

             <!-----Main-content section  Start------->
     <div class="main-content">
       <div class="wrapper">
              <h1>Manage Admin</h1>

                    <br>

                    <?php
                     if(isset($_SESSION['add']))
                    {
                           echo  $_SESSION['add'];//Display session message
                           unset( $_SESSION['add']);//Remove session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                           echo $_SESSION['delete'];
                           unset( $_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                           echo $_SESSION['update'];
                           unset( $_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                           echo $_SESSION['user-not-found'];
                           unset( $_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['password-not-match']))
                    {
                           echo $_SESSION['password-not-match'];
                           unset( $_SESSION['password-not-match']);
                    }

                    if(isset($_SESSION['change_password']))
                    {
                           echo $_SESSION['change_password'];
                           unset( $_SESSION['change_password']);
                    }
                    ?>
                    <br>
<!-----------Button for Adding ADMINS---------------->
              <a href="add-admin.php" class="btn-primary">Add Admin</a>

                   <br> <br>
              <table class="tbl-full">
                     <tr>
                            <th>S.N.</th>
                            <th>Full name</th>
                            <th>Username</th>
                            <th>Actions</th>
                     </tr>
                                          <?php
                                          //Query to get all admin
                                          $sql="SELECT * FROM  tbl_admin";
                                          //Execute the query
                                          $res=mysqli_query($conn,$sql);
                                          //check whether the query is executed or not
                                          if($res==TRUE){
                                                 //count the rows to check whether  we have data in database or not
                                                 $count=mysqli_num_rows($res);//function to get all rows in the database


                                                 $sn=1;//create a variable and assign the value
                                                 //check the num of rows

                                                 if($count>0)
                                                 {
                                                        //We have data in the database
                                          while($rows=mysqli_fetch_assoc($res))
                                          {
                                                 //using while loop to get all the data in the database
                                                 //and the while loop will execute so long as we have data in the database

                                                 //Get individual data
                                                 $id=$rows['id'];
                                                 $full_name = $rows['full_name'];
                                                 $username = $rows["username"];

                                                 //Dispaly the values in the table 
                                          ?>
              
                            <tr>
                                                        <td><?php echo $sn++;?></td>
                                                        <td><?php echo $full_name;?></td>
                                                        <td><?php echo $username;?></td>
                                                        <td> <a href="<?php echo SITEURL;  ?>admin/update-password.php? id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                                        <a href="<?php echo SITEURL;  ?>admin/update-admin.php? id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                        <a href="<?php echo SITEURL;  ?>admin/delete-admin.php? id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                                        </td>
                                                 </tr>

                            <?php


                            }
                                   }else
                                   {
                                          //We do not have data in the database
                                   }

                            }

                            ?>

              </table>
             
     </div>
     </div>
            <!-----Main-content section  End------->

            
            <?php include('partials/footer.php');?>
            