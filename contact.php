<?php
session_start();
//connect Db and user check 
include("db.php");
include("function.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

  
    $insert_query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo("Thank you  for your Message!");
        header("Location: contact.php");
        exit(); 
    } else {
        
        $error_message = "Failed to insert message. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="contact.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="contact-container">
        <h1 class="contactTitle">Contact Us</h1>
        <div class="form-container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <input type="submit" value="Send Message">
            </form>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>