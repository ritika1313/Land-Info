<?php
$conn = new mysqli("localhost", "root", "", "land_insights");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>
            alert('Login successful!');
            window.location.href = 'navbar.html';
          </script>";
} else {
    echo "<script>
            alert('Invalid email or password!');
            window.history.back();
          </script>";
}

$stmt->close();
$conn->close();
?>