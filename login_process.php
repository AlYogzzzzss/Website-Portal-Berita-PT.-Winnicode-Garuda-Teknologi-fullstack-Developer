<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Default username XAMPP
$password = ""; // Default password XAMPP
$dbname = "db_admin"; // Nama database yang telah diubah

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form dan sanitasi
$user = trim($_POST['username']);
$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validasi input
if (empty($user) || empty($full_name) || empty($email) || empty($password)) {
    die("All fields are required.");
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

// Siapkan dan jalankan pernyataan
$stmt = $conn->prepare("INSERT INTO admins (username, email, role, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $email, $role, $hashed_password);

// Set a default role (you can modify this as needed)
$role = 'viewer'; // Default role, can be changed based on your application logic

if ($stmt->execute()) {
    // Redirect after successful registration
    header("Location: login.html");
    exit();
} else {
    // Log error message instead of displaying it
    error_log("Database error: " . $stmt->error);
    die("Registration failed. Please try again later.");
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>