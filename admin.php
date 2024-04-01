<?php
session_start();
include("db.php");
include("function.php");

$user_data = check_login($con);

// Check if the user is an admin
if ($user_data['user_Type'] !== 'admin') {
    header("Location: index.php"); // Redirect to index
    exit();
}
// Fetch messages from the database
$query = "SELECT * FROM messages ORDER BY created_at DESC";
$result = mysqli_query($con, $query);

// Check if any messages are found
$messages = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anta" />
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="admin-container">
        <h1>Welcome to the Admin Panel, <?php echo $user_data['user_FirstName']; ?>!</h1>

        <!-- Display messages -->
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="message-card">
                    <p><strong>Name:</strong> <?php echo $message['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $message['email']; ?></p>
                    <p><strong>Message:</strong> <?php echo $message['message']; ?></p>
                    <p><strong>Received At:</strong> <?php echo $message['created_at']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages found.</p>
        <?php endif; ?>
    </div>
</body>
</html>