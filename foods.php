<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
            //display foods that are actve
            $sql="SELECT * FROM tbl_food WHERE active= 'Yes' " ;
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //count rows
            $count=mysqli_num_rows($res);
            //check whether foods are available or not
            if($count>0)
            {
                //Foods available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values
                    $id=$row['id'];
                    $tittle=$row['tittle'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                }
                ?>
                    <div class="food-menu-box">
                    <div class="food-menu-img">
                    <?php 
                    //Check whether image is available or not
                    if($image_name=="")
                    {
                        //Image not available
                        echo "<div class='error>Image Not Available.</div>";
                    }
                    else
                    {
                        //Image Available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawa" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $tittle;?></h4>
                        <p class="food-price">Ksh:<?php echo $price;?></p>
                        <p class="food-detail">
                          <?php echo $description;?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

           

                <?php
            }
            else
            {
                //Foods not available
                echo "<div class='error>Food not found.</div>";
            }

          
            ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
</body>
</html>