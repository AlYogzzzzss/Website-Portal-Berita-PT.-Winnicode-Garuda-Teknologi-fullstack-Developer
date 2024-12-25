<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Default username XAMPP
$password = ""; // Default password XAMPP
$dbname = "user_db"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$user = $_POST['username'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

// Siapkan dan jalankan pernyataan
$stmt = $conn->prepare("INSERT INTO users (username, full_name, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $full_name, $email, $password);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}
header("Location: login.html");
exit();
?>