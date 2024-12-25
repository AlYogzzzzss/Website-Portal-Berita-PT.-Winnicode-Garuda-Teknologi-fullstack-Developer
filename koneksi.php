<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "nama_database"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$judul = $_POST['judul'];
$konten = $_POST['konten'];

// Proses upload gambar
$target_dir = "uploads/"; // Pastikan folder ini ada dan dapat ditulis
$target_file = $target_dir . basename($_FILES["gambar"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file gambar adalah gambar sebenarnya
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        echo "File yang diupload bukan gambar.";
        exit;
    }
}

// Cek apakah file sudah ada
if (file_exists($target_file)) {
    echo "Maaf, file sudah ada.";
    exit;
}

// Cek ukuran file
if ($_FILES["gambar"]["size"] > 500000) { // 500KB
    echo "Maaf, ukuran file terlalu besar.";
    exit;
}

// Izinkan format file tertentu
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    exit;
}

// Jika semua cek lolos, coba untuk upload file
if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
    // Simpan data ke database
    $sql = "INSERT INTO berita (judul, konten, gambar) VALUES ('$judul', '$konten', '$target_file')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil diupload.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Maaf, terjadi kesalahan saat mengupload file.";
}

// Tutup koneksi
$conn->close();
?>