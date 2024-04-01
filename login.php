<?php
session_start();
include("db.php");
include("function.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_Name = $_POST['user_Email']; //email
    $user_Pass = $_POST['user_Password']; //pass
    if (!empty($user_Name) && !empty($user_Pass)) {
        //read from db
        $query = "select * from users where user_Email = '$user_Name' limit 1";

        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['user_Password'] === $user_Pass) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
    } else {
        //No data or fails 
        echo "<div class='error'>Wrong Email or Password, Please Try again</div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <tittle>
        </title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta">
        
</head>

<body>
    <style> </style>
    <div class="container" id="box">
        <form method="post">
            <h1>Please Sign in</h1>
            <input placeholder="Email" id="text" type="email" name="user_Email"> <br><br>
            <input placeholder="Password" id="text" type="password" name="user_Password"><br><br>
            <input id="button" type="submit" value="Login"><br><br>
            <a href="signup.php">Create an account here</a><br><br>
        </form>
    </div>

</body>

</html>