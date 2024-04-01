<?php
session_start();
include("db.php");
include("function.php");

$user_data = check_login($con);

//Fpr SELECTS
$selectedMake = $_POST['MAKE'];
$selectedModel = $_POST['MODEL'];
$selectedColour = $_POST['COLOR'];
$selectedPrice = $_POST['PRICE'];

//FOR GOING TO ORDER PAGE
// Handle adding to basket on the "orders.php" page

$itemId = $_GET['productId'];
$itemModel = $_POST['productModel'];
$itemMake = $_POST['productMake'];
$itemPrice = $_POST['productPrice'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css" />
    <title>Search Page</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="searchContainer">
        <h1 class="searchTitle">Search Here</h1>
        <div class="formContainer">
            <form method="POST" action="search.php">
                <select name="MAKE">
                    <option disabled selected> Make </option>
                    <?php
                    $queryMake = "SELECT DISTINCT make FROM `vehicle` ORDER BY make ASC";
                    $resultMake = mysqli_query($con, $queryMake);
                    while ($row = mysqli_fetch_array($resultMake)) {
                        echo "<option value='" . $row['make'] . "'>" . $row['make'] . "</option>";
                    }
                    ?>
                </select>
                <select name="MODEL">
                    <option disabled selected> Model </option>
                    <?php
                    $queryModel = "SELECT DISTINCT model FROM `vehicle` ORDER BY model ASC";
                    $resultModel = mysqli_query($con, $queryModel);
                    while ($row = mysqli_fetch_array($resultModel)) {
                        echo "<option value='" . $row['model'] . "'>" . $row['model'] . "</option>";
                    }
                    ?>
                </select>
                <select name="COLOR">
                    <option disabled selected> Colour </option>
                    <?php
                    $queryColour = "SELECT DISTINCT colour FROM `vehicle` ORDER BY colour ASC";
                    $resultColour = mysqli_query($con, $queryColour);
                    while ($row = mysqli_fetch_array($resultColour)) {
                        echo "<option value='" . $row['colour'] . "'>" . $row['colour'] . "</option>";
                    }
                    ?>
                </select>
                <select name="PRICE">
                    <option disabled selected> Price </option>
                    <?php
                    $queryPrice = "SELECT DISTINCT price FROM `vehicle` ORDER BY price ASC";
                    $resultPrice = mysqli_query($con, $queryPrice);
                    while ($row = mysqli_fetch_array($resultPrice)) {
                        echo "<option value='" . $row['price'] . "'>" . $row['price'] . "</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="submit" value="Search"> 
            </form>
        </div>

        <div class="cardContainer">
            <!--Search Make-->
            <?php
            $searchMake = "SELECT make, model, relyr, colour, price, pic, ve_id FROM vehicle WHERE make = '$selectedMake' AND availability > 0";
            $resultMake = mysqli_query($con, $searchMake);

            if ($resultMake) {
                while ($res = mysqli_fetch_assoc($resultMake)) { ?>
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
                            <button type="submit" name="add_to_basket">Add to Basket</button> <!--Adding to basket -->
                        </form>
                    </div>
                <?php
                }
            }
            ?>

            <!--Search Model-->
            <?php
            $searchModel = "SELECT make, model, relyr, colour, price, pic, ve_id FROM vehicle WHERE model = '$selectedModel' AND availability > 0 ";
            $resultModel = mysqli_query($con, $searchModel);

            if ($resultModel) {
                while ($res = mysqli_fetch_assoc($resultModel)) { ?>
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
                            <button type="submit" name="add_to_basket">Add to Basket</button> <!--Adding to basket -->
                        </form>
                    </div>
                <?php
                }
            }
            ?>

            <!--Search Colour-->
            <?php
            $searchColour = "SELECT make, model, relyr, colour, price, pic, ve_id FROM vehicle WHERE colour = '$selectedColour' AND availability > 0";
            $resultColour = mysqli_query($con, $searchColour);

            if ($resultColour) {
                while ($res = mysqli_fetch_assoc($resultColour)) { ?>
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
                            <button type="submit" name="add_to_basket">Add to Basket</button> <!--Adding to basket -->
                        </form>
                    </div>
                <?php
                }
            }
            ?>

            <!--Search Price-->
            <?php
            $searchPrice = "SELECT make, model, relyr, colour, price, pic, ve_id FROM vehicle WHERE price = '$selectedPrice' AND availability > 0";
            $resultPrice = mysqli_query($con, $searchPrice);

            if ($resultPrice) {
                while ($res = mysqli_fetch_assoc($resultPrice)) { ?>
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


    </div>
</body>

</html>
