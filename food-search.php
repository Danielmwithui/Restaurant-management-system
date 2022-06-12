<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            //Get the search keyword
            $search =$_POST['search'];
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //sql query to get food based on search keyword
            $sql="SELECT * FROM tbl_food  WHERE tittle LIKE '%$search%' OR description LIKE '%$search%'";
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //count the rows
            $count=mysqli_num_rows($res);
            //Check whether food is available or not
            if($count>0)
            {
                //Food available
                while($row=mysqli_fetch_assoc($res))
                {
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
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                <?php
            }
            else
            {
                //Food not available
                echo  "<div class='error'>Food not available</div>";
        
            }
                
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
</body>
</html>