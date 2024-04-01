<?php

function check_login($con) //checking login function
{
    if (isset($_SESSION['user_id'])) //cheking for value set
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
    
            return $user_data;
        }
    } else {
        //user redirected to login 
        header("Location: login.php");
        die;

    }

}

if (isset($_POST['orderConfirm'])) {
    // Extract data from the POST request
    $itemId = isset($_POST['productId']) ? $_POST['productId'] : '';
    $itemModel = isset($_POST['productModel']) ? $_POST['productModel'] : '';
    $itemMake = isset($_POST['productMake']) ? $_POST['productMake'] : '';
    $itemPrice = isset($_POST['productPrice']) ? $_POST['productPrice'] : '';

    // Update availability in the original table
    $updateQuery = "UPDATE vehicle SET availability = 0 WHERE ve_id = $itemId";
    mysqli_query($con, $updateQuery);

    // Insert data into the orders table
    $insertQuery = "INSERT INTO orders (ve_id, model, make, price, user_id) VALUES ('$itemId', '$itemModel', '$itemMake', '$itemPrice', '$user_data')";
    mysqli_query($con, $insertQuery);

    // Redirect to a page showing the order confirmation
    header("Location: confirmOrder.php");
    exit();
}