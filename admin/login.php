<?php include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="txt-centre">Login</h1>
        <br><br>

        <?php
          if(isset($_SESSION['login']))
          {
                 echo $_SESSION['login'];
                 unset( $_SESSION['login']);
          }

          if(isset($_SESSION['no-login-message']))
          {
              echo  $_SESSION['no-login-message'];
              unset($_SESSION['no-login-message']);
          }
        ?>
        <br><br>
        <!-------Login form starts here--------->
        <form action="" method="post" class="txt-centre">
            Username:<br>
            <input type="text" name="username" placeholder="Enter username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
      
        <p class="txt-centre">Created By - <a href="www.DeeWebSolution.com">Daniel Mwithui</a></p>
    </div>
</body>
</html>

<?php
//check whether the submit button is clicked
if(isset($_POST['submit']))
                {
                            //process for login 
                            
                            //1.Get the Data from Login form
                            $username=$_POST['username'];
                            $password=md5($_POST['password']);
        
                            //SQL to check whether the user with username and password exists or not
                            $sql="SELECT * FROM tbl_admin  WHERE username='$username' AND password='$password' ";

                            //Execute the query
                            $res=mysqli_query($conn, $sql);

                            //count rows to check  whether user exists or not
                            $count=mysqli_num_rows($res);

                                if ($count==1)
                                        {
                                            //User Available and Login success
                                            $_SESSION['login']="<div class='success ' >Login Successful.</div>";
                                            //To Check whether user is logged in or not  and logout will unset it
                                             $_SESSION['user']=$username;//To check whether the user is logged in or not

                                            //Redirect the user
                                            header('Location:'.SITEURL.'admin/');   
                                        }
                                        else
                                        {
                                            //User not available and login fail
                                            $_SESSION['login']="<div class='error txt-centre' >Wrong Username or Password.</div>";
                                            //Redirect the user
                                            header('Location:'.SITEURL.'admin/login.php');  
                                    }
                }


?>