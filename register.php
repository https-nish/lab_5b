<?php
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $accessLevel = $_POST['accessLevel'];

    $sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES ('$matric', '$name', '$password', '$accessLevel')";
    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form method="POST" action="register.php">
            <label>Matric:</label>
            <input type="text" name="matric" placeholder="Enter your matric number" required>
            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter your full name" required>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter a secure password" required>
            <label>Access Level:</label>
            <select name="accessLevel" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <div class="logout-link">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
