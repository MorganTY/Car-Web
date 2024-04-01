<?php
session_start();

//connect Db and user check Please goto--
//http://www.morganlee.uosweb.co.uk/login.php
//To sign in and use the login details. 
//Email:
//admin@admin.com
//Password:
//admin 
//To view the Admin Panel please go to:
//http://www.morganlee.uosweb.co.uk/admin.php

include("db.php");
include("function.php");

$user_data = check_login($con);
$itemId = $_GET['productId'];
$itemModel = $_POST['productModel'];
$itemMake = $_POST['productMake'];
$itemPrice = $_POST['productPrice'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="homeContainer">
        
    <div class="imageContainer">
    <img class="largeImage" src="STOCK.jpg" alt="Large Image">
    <div class="imageText">
        <h1 class="largeTitle">Welcome <?php echo $user_data['user_FirstName']; ?> To Cars Now</h1>
    </div>
</div>

        <div class="pageTextContainer">
            <h2 class="pageTextTitle">Explore Our New Additions Today!</h2>
            <p class="pageTextContent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget turpis vel
                urna imperdiet laoreet. Fusce eget tristique justo. Sed id tellus vitae eros venenatis scelerisque.
                Quisque eleifend urna a velit feugiat, nec efficitur orci venenatis.</p>
            <div class="cardContainer">
               
                <?php
                
                $searchRecent = "SELECT make, model, colour, price, pic from vehicle ORDER BY ve_id desc limit 4";
                $resultRecent = mysqli_query($con, $searchRecent);
                if ($resultRecent) {
                    while ($res = mysqli_fetch_assoc($resultRecent)) {
                        ?>
                        <div class="card">
                            <img class="cardImage" src="<?php echo $res['pic']; ?>" alt="Product Image">
                            <h3 class="cardTitle">
                                <?php echo $res['make'] . ' ' . $res['model']; ?>
                            </h3>
                            <p class="cardColor">
                                <?php echo $res['colour']; ?>
                            </p>
                            <p class="cardPrice"> £
                                <?php echo $res['price']; ?>
                            </p>
                            <p class="cardDescription">Lorem ipsum dolor sit amet, consectetur </p>
                            <form method="post" action="order.php">
                            <input type="hidden" name="productId" value="<?php echo $res['ve_id']; ?>">
                            <input type="hidden" name="productModel" value="<?php echo $res['model']; ?>">
                            <input type="hidden" name="productMake" value="<?php echo $res['make']; ?>">
                            <input type="hidden" name="productPrice" value="<?php echo $res['price']; ?>">
                            <button type="submit" name="add_to_basket">Create Order</button> <!--Adding to basket -->
                        </form>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

</body>

</html>