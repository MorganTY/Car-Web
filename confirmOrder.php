<?php
session_start();
//connect Db and user check 
include("db.php");
include("function.php");

$user_data = check_login($con);
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
        <h1 class="orderTitle">Order Confirmation</h1>
        <p>Your order has been confirmed!</p>
    </div>
</body>

</html>