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
    <!-- food search Section Ends Here -->
            <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset($_SESSION['order']) ;
            }
            ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            //Create sql query to display categories from Database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //Count the rows to check whether category is available
            $count=mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values 
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    
            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id ?>">
            <div class="box-3 float-container">
                <?php
                //Check whether image is available or not
                if($image_name==" ")
                {
                    echo  "<div class='error'>Image not available</div>";
                }
                else
                {
                    //Image Available
                    ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                }
                ?>

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>

                    <?php
                }

            }
            else
            {
                //Categories not available
                echo "<div class='error'>Category not added</div>";
            }
            ?>
            </div>
            </a>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //Getting fro database that are active and featured
            //SQL query
            $sql2="SELECT * FROM tbl_food  WHERE active='Yes' AND featured='Yes' LIMIT 6" ;
            //Executte the query 
            $res2=mysqli_query($conn,$sql2);

            //Count the rows
            $count2=mysqli_num_rows($res2);
            //Check whether food is available or not
            if($count2>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id=$row['id'];
                    $tittle=$row['tittle'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                      <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    //Check whether image is availabnle or not
                    if($image_name=="")
                    {
                        //Image not available
                        echo "<div class='error'>Image not available.</div>";
                    }
                    else
                    {
                        //Image available
                        ?>
                    <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $tittle;?></h4>
                    <p class="food-price">Ksh:<?php echo $price ;?></p>
                    <p class="food-detail">
                        <?php echo $description ;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php

                }
            }
            else 
            {
                //Food not available
                echo "<div class='error'>Food not available.</div>";
            }

            ?>
            <div class="clearfix"></div>
                </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php');?>
</body>
</html>