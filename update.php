<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    $sql = "UPDATE users SET matric = '$matric', name = '$name', accessLevel = '$accessLevel' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: display.php');
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label>Matric:</label>
            <input type="text" name="matric" value="<?php echo $user['matric']; ?>" required>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <label>Access Level:</label>
            <select name="accessLevel">
                <option value="user" <?php echo $user['accessLevel'] === 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $user['accessLevel'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
            <button type="submit">Update</button>
        </form>
        <a href="display.php">Cancel</a>
    </div>
</body>
</html>
