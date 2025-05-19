<?php
require_once 'db.php'; // get the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if form sended, this block works.
 
    $username = trim($_POST["username"]); // Get Username and Delete paces (using trim)
    $password = $_POST["password"];       // Get Password

    // 1. check if the user exists
    $check = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $check->bindParam(":username", $username);
    $check->execute();

    if ($check->rowCount() > 0) { // if check up bigger than 0 (username is more than 0)
        echo "This username is already taken.";
    } else {
        // 2. Secure Password (hashle)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 3. Add user to database
        $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $insert->bindParam(":username", $username);
        $insert->bindParam(":password", $hashedPassword);

        if ($insert->execute()) {
            echo '<div class="success">Registration Successfully! You\'re going to login page...</div>';
            header("Refresh: 2; url=login.php");
        } else {
            echo '<div class="error">An error occurred on registration.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css\register.css">
</head>
<body>
    <div id="signup">
        <h2>User Registration</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Sign Up</button>
        </form>
        <p><a href="login.php">Do you already have an account? Login</a></p>
    </div>
</body>
</html>