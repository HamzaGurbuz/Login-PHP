<?php
session_start();
require_once 'db.php';
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(":username", $username);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        echo '<div class="success">Login Successful, Welcome ' . htmlspecialchars($user["username"]) . '!</div>';
        // header("Location: panel.php"); // redirect if you want
    } 
    else {
        echo '<div class="error">Username or password is wrong.</div>';
}
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="login">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button><br><br>
            <a href="register.php">Don't have an account? Sign Up</a>
        </form>
    </div>
</body>
</html>
