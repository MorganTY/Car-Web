<?php
session_start();
//connect Db and user check 
include("db.php");
include("function.php");

$user_data = check_login($con);


$user_id = $user_data['user_id'];

$order_query = "SELECT * FROM orders WHERE user_id = '$user_id'";
$order_result = mysqli_query($con, $order_query);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="orderPage.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="orderContainer">
        <h1 class="orderTitle">Your Orders</h1>

        <?php if (mysqli_num_rows($order_result) > 0) : ?>
            <div class="orderList">
                <?php while ($row = mysqli_fetch_assoc($order_result)) : ?>
                    <div class="orderItem">
                        <p>Order ID: <?php echo $row['order_id']; ?></p>
                        <p>Model: <?php echo $row['model']; ?></p>
                        <p>Make: <?php echo $row['make']; ?></p>
                        <p>Price: £<?php echo $row['price']; ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>

</html>