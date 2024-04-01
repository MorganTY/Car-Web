<?php
session_start();
//connect Db and user check 
include("db.php");
include("function.php");

$user_data = check_login($con);


$print = $user_data['user_id'];

if (!empty($_POST)) {
    // Extract data from the POST request
    $itemId = isset($_POST['productId']) ? $_POST['productId'] : '';
    $itemModel = isset($_POST['productModel']) ? $_POST['productModel'] : '';
    $itemMake = isset($_POST['productMake']) ? $_POST['productMake'] : '';
    $itemPrice = isset($_POST['productPrice']) ? $_POST['productPrice'] : '';

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="order.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
    </head>

    <body>
        <!-- Navbar -->
        <?php include 'nav.php'; ?>
        <!-- Main Content -->
        <div class="orderContainer">
            <h1 class="orderTitle">Your Order</h1>
            <p>Item ID:
                <?php echo $itemId; ?>
            </p>
            <p>Model:
                <?php echo $itemModel; ?>
            </p>
            <p>Make:
                <?php echo $itemMake; ?>
            </p>
            <p>Price: £
                <?php echo $itemPrice; ?>
            </p>
            <form method="post" action="order.php">
            <input type="hidden" name="productIdConfirm" value="<?php echo $itemId; ?>">
            <input type="hidden" name="productModelConfirm" value="<?php echo $itemModel; ?>">
            <input type="hidden" name="productMakeConfirm" value="<?php echo $itemMake; ?>">
            <input type="hidden" name="productPriceConfirm" value="<?php echo $itemPrice; ?>">
            <button type="submit" name="orderConfirmConfirm">Confirm Order</button>
        </form>
            <?php
            if (isset($_POST['orderConfirmConfirm'])) {
                // Extract data from the POST request
                $itemIdConfirm = isset($_POST['productIdConfirm']) ? $_POST['productIdConfirm'] : '';
                $itemModelConfirm = isset($_POST['productModelConfirm']) ? $_POST['productModelConfirm'] : '';
                $itemMakeConfirm = isset($_POST['productMakeConfirm']) ? $_POST['productMakeConfirm'] : '';
                $itemPriceConfirm = isset($_POST['productPriceConfirm']) ? $_POST['productPriceConfirm'] : '';

                // Update availability in the original table
                $updateQuery = "UPDATE vehicle SET availability = 0 WHERE ve_id = $itemIdConfirm";
                mysqli_query($con, $updateQuery);
                
                // Insert data into the orders table
                $orderCreate = "INSERT INTO orders (ve_id, model, make, price, user_id) VALUES ('$itemIdConfirm', '$itemModelConfirm', '$itemMakeConfirm', '$itemPriceConfirm', '$print')";
                mysqli_query($con, $orderCreate);

                // Redirect to a page showing the order confirmation
                header("Location: confirmOrder.php");
                exit();
            }


} else {

    ?>

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet"
                    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
                <link rel="stylesheet" href="order.css" />
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
            </head>

            <?php include 'nav.php'; ?>
            <div class="orderContainer">
            <h1 class="orderTitle">No current orders</h1>
            </div>
    </body>

    </html>
    <?php
} ?>