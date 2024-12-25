<?php

// Koneksi database
$host = 'localhost';
$user = 'root';
$password = ''; // Ganti dengan password MySQL Anda
$database = 'db_admin';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function menu() {
    echo "\n--- Admin CLI Menu ---\n";
    echo "1. Tambah Admin\n";
    echo "2. Lihat Admin\n";
    echo "3. Edit Admin\n";
    echo "4. Hapus Admin\n";
    echo "5. Keluar\n";
    echo "Pilih opsi: ";
}

function tambahAdmin($conn) {
    echo "Masukkan username: ";
    $username = trim(fgets(STDIN));
    echo "Masukkan email: ";
    $email = trim(fgets(STDIN));
    echo "Masukkan role (admin/editor/viewer): ";
    $role = trim(fgets(STDIN));
    echo "Masukkan password: ";
    $password = password_hash(trim(fgets(STDIN)), PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO admins (username, email, role, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $role, $password);

    if ($stmt->execute()) {
        echo "Admin berhasil ditambahkan.\n";
    } else {
        echo "Error: " . $stmt->error . "\n";
    }
    $stmt->close();
}

function lihatAdmin($conn) {
    $result = $conn->query("SELECT id, username, email, role, created_at FROM admins");
    echo "\n--- Daftar Admin ---\n";
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id']} | Username: {$row['username']} | Email: {$row['email']} | Role: {$row['role']} | Created At: {$row['created_at']}\n";
    }
}

function editAdmin($conn) {
    echo "Masukkan ID admin yang akan diedit: ";
    $id = trim(fgets(STDIN));
    echo "Masukkan username baru: ";
    $username = trim(fgets(STDIN));
    echo "Masukkan email baru: ";
    $email = trim(fgets(STDIN));
    echo "Masukkan role baru (admin/editor/viewer): ";
    $role = trim(fgets(STDIN));

    $stmt = $conn->prepare("UPDATE admins SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        echo "Admin berhasil diperbarui.\n";
    } else {
        echo "Error: " . $stmt->error . "\n";
    }
    $stmt->close();
}

function hapusAdmin($conn) {
    echo "Masukkan ID admin yang akan dihapus: ";
    $id = trim(fgets(STDIN));

    $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Admin berhasil dihapus.\n";
    } else {
        echo "Error: " . $stmt->error . "\n";
    }
    $stmt->close();
}

while (true) {
    menu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            tambahAdmin($conn);
            break;
        case 2:
            lihatAdmin($conn);
            break;
        case 3:
            editAdmin($conn);
            break;
        case 4:
            hapusAdmin($conn);
            break;
        case 5:
            echo "Keluar.\n";
            $conn->close();
            exit;
        default:
            echo "Pilihan tidak valid.\n";
    }
}

?>
