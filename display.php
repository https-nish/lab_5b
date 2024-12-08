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

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Users List</h2>
        <table>
            <thead>
                <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Access Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['matric']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['accessLevel']; ?></td>
                        <td class="action-links">
                            <a href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
