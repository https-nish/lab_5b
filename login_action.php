<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

$matric = $_POST['matric'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE matric='$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $row['name'];
        header('Location: display.php');
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found.";
}
$conn->close();
?>
