<?php
$conn = new mysqli("localhost", "root", "", "land_insights");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

if ($password !== $repeat_password) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit;
}

$sql = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);

if ($stmt->execute()) {
    echo "<script>
            alert('Signup successful!');
            window.location.href = 'navbar.html';
          </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>