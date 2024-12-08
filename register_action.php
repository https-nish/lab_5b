<?php
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_POST['matric'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$accessLevel = $_POST['accessLevel'];

$sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES ('$matric', '$name', '$password', '$accessLevel')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! <a href='login.php'>Login here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
