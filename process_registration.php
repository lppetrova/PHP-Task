<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, phone, password, email) VALUES (:first_name, :last_name, :phone, :password, :email)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Registration successful! You can <a href='login.php'>log in here</a>.";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
