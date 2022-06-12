<?php

//include constants.php
include('../config/constants.php');

//process the value from the Form and save in the database

//Check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked else button not clicked
   // echo "button clicked";
    //Get the data from form
     $full_name=$_POST['full_name'];
     $username=$_POST['username'];
     $password=md5($_POST['password']);

      //SQL query to  save the data into the database
$sql="INSERT into tbl_admin  SET
full_name='$full_name',
username='$username',
password='$password'
";
//Execute query and insert data into a database
$res=mysqli_query($conn,$sql);

//check whether thw query is executed
if($res==TRUE)
{
    //Data inserted
    //echo "Data inserted successfully";
    //create a session variable to display message
    $_SESSION['add']="<div class='success'>Admin added successfully</div>";
    //Redirect page
    header("Location:".SITEURL."admin/manage-admin.php");
}else

{
//Failed to insert data
//echo "Data not inserted";
//create a session variable to display message
$_SESSION['add']="<div class ='error'>Failed to add Admin</div>";
//Redirect page
header("Location:".SITEURL."admin/add-admin.php");
}
}



?>
<?php include('partials/menu.php');?>
 <!-----Main-content section  Start------->
 <div class="main-content">
       <div class="wrapper">
              <h1>Add Admin</h1>
              <br><br>

                <?php
                if(isset($_SESSION['add']))
                {
                    echo  $_SESSION['add'];//Display session message
                    unset( $_SESSION['add']);//Remove session message
                }
                ?>
                <br>
            <form action="add-admin.php" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Enter your Username"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Enter your password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add admin" class="btn-secondary">
                        </td>
                       
                    </tr>
                </table>
            </form>
       </div>
     </div>
            <!-----Main-content section  End------->

<?php include('partials/footer.php');?>


