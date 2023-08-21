<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['user_email'] = $row['email'];
        
        header("Location: profile.php"); 
        exit();
    } else {
        echo "Login failed. Incorrect password.";
    }
} else {
    echo "Login failed. User not found.";
}

$conn->close();
?>
