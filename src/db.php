<?php
$host = "localhost"; // Host
$dbname = "deneme1"; // Database name crated in phpMyAdmin
$user = "root"; // Root is usually required in tools like XAMPP / MAMP / Laragon
$pass = "";     // if Password is empty do like this

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Connect to database and give the Turkish language support

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Let's catch errors with try-catch
} catch (PDOException $e) {
    die("Connection Error: " . $e->getMessage());
    // If have a connection error, stop and show the message
}


?>


