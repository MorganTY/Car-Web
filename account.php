<?php
session_start();
//connect Db and user check 
include("db.php");
include("function.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userFirstN = $_POST['userFirstN'];
    $userLastN = $_POST['userLastN'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update user information in the database
    $update_query = "UPDATE users SET user_FirstName='$userFirstN', user_LastName='$userLastN', user_Email='$email', user_Password='$password' WHERE user_id=" . $user_data['user_id'];
    $update_result = mysqli_query($con, $update_query);
    if ($update_result) {
        // Update successful
        header("Refresh:0");
    } else {
        // Update failed
        $error_message = "Failed to update. Please Try Again Later.";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="account.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="accountContainer">
        <h1 class="accountTitle">Your Account</h1>

        <div class="userInfo">
            <h2 class="userInfoH2">Users Info</h2>
            <p><strong>First Name:</strong> <?php echo $user_data['user_FirstName']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $user_data['user_LastName']; ?></p>
            <p><strong>Email:</strong> <?php echo $user_data['user_Email']; ?></p>
        </div>

        <div class="formContainer">
            <form method="POST" action="">
                <label for="username">First Name</label>
                <input type="text" id="userFirstN" name="userFirstN" value="<?php echo $user_data['user_FirstName']; ?>">

                <label for="userLastN">Last Name</label>
                <input type="text" id="userLastN" name="userLastN" value="<?php echo $user_data['user_LastName']; ?>">
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $user_data['user_Email']; ?>">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $user_data['user_Password']; ?>">

                <input type="submit" value="Update">
            </form>
            <?php if (isset($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>