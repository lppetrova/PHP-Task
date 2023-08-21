<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

$servername = "localhost";
$username = "root";
$password = "password";
$database = "test";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE id = $user_id"; 

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
}

echo $user_data;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_first_name = $_POST['first_name'];
    $new_last_name = $_POST['last_name'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    $new_password = $_POST['new_password'];
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $update_password_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
        if ($conn->query($update_password_sql) !== TRUE) {
            echo "Error updating password: " . $conn->error;
        }
    }

    $update_user_sql = "UPDATE users SET first_name = '$new_first_name', last_name = '$new_last_name', email = '$new_email', phone = '$new_phone' WHERE id = $user_id";
    
    if ($conn->query($update_user_sql) === TRUE) {
        echo "User information updated successfully.";
    } else {
        echo "Error updating user information: " . $conn->error;
    }
    $conn->close();    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Welcome, <?php echo $user_email; ?>!</p>

    <h2>Your Information:</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user_email; ?>" required><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $user_data['phone']; ?>" required><br>

        <label for="password">New Password:</label>
        <input type="password" name="new_password"><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
