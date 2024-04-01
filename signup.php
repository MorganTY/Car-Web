<?php
include("db.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_Name = $_POST['user_Name']; //email
    $user_Pass = $_POST['user_Pass']; //pass
    $user_First = $_POST['user_First']; //first
    $user_Last = $_POST['user_Last']; //last

    if (!empty($user_Name) && !empty($user_Pass)) {
        //insert into db
        $query = "insert into users (user_Email,user_Password,user_FirstName,user_LastName) values ('$user_Name','$user_Pass','$user_First','$user_Last')";

        mysqli_query($con, $query);

        header("Location: index.php");
        die;
    } else {
        echo "<div class='error'>Please Fill in All Fields</div>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <Title>SignUP</Title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta">
    <link rel="stylesheet" href="signup.css">

</head>

<body>
    <div class="container" id="box">
        <h1>Welcome to Little Planet</h1>
        <form class="form" method='post'>
            <h1>Create Account</h1>
            <input placeholder="Email" id="text" type="email" name="user_Name"><br></br></input>
            <input placeholder="Password" id="text" type="password" name="user_Pass"><br></br> </input>
            <input placeholder="First Name" id="text" type="text" name="user_First"><br></br> </input>
            <input placeholder="Last Name" id="text" type="text" name="user_Last"><br></br> </input>
            <input id="button" type="submit" value="Signup"><br></br> </input>
            <a href="login.php">Login Here</a><br></br>
        </form>
    </div>
</body>

</html>