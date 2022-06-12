<?php include('partials/menu.php');?>
   <!-----Main-content section  Start------->
   <div class="main-content">
       <div class="wrapper">
              <h1>Update Admin</h1>
              <br><br>

              <?php
              //Get the id of selected admin
              $id=$_GET['id'];

              //2.Create SQL query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //Check whether the query is executed
            if($res==true)
            {
               //check whether the data is available or not
               $count=mysqli_num_rows($res) ;
               //check whether we have admin data or not
               if($count==1)
               {
                                //Get the details
                        //echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $username=$row['username'];
               }
               else
               {
                     //Redirect to Manage Admin Page
                header('Location:'.SITEURL.'admin/manage-admin.php');
               } 
            }
              ?>
              <form action="" method="POST">
              <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter your Name" value="<?php echo $full_name;?>"> 
                    </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Enter your Username" value="<?php echo  $username;?>">
                         </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
                
              </form>
              
     </div>
     </div>

     <?php
     //Check whether the submit button is clicked
     if(isset($_POST['submit']))
     {
        echo "Button Clicked";
         //Get all the values from form update
         $id=$_POST['id'];
         $full_name=$_POST['full_name'];
         $username=$_POST['username'];
         //Create a SQL query to update Admin
         $sql="UPDATE tbl_admin  SET 
         full_name='$full_name',
         username='$username'
         WHERE id='$id'
         ";
         //Execute the query 
         $res=mysqli_query($conn,$sql);
         //Chec the query executed successsfully or not
         if($res==true)
         {
             //Query executed and Admin updated
             $_SESSION['update']="<div class='success'>Admin updated successfully.</div>";
             //Redirect to Manage admin Page
             header('Location:'.SITEURL.'admin/manage-admin.php');   

         }
         else
         {
             //Failed to update Admin
             $_SESSION['update']="<div class='error'>Failed to update  Admin.</div>";
             //Redirect to Manage admin Page
             header('Location:'.SITEURL.'admin/manage-admin.php');   

         }
     }
     
     ?>
            <!-----Main-content section  End------->

<?php include('partials/footer.php');?>