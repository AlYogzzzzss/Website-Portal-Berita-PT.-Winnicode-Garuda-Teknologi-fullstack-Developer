Biodata Mahasiswa universitas Krisnadwipayana dalam melaksanakan magang mandiri kampus merdeka batch 7 selama 4 bulan di PT. Winnicode Garuda Teknologi Devisi Fullstack Developer.
Kelompok :
Nama 	: Alka Prayoga, Email : alkhaprayogha15@gmail.com 
Nama 	: Muhamad Rifki Aulia Rahman, Email : 123rifky88@gmail.com

Tutorial Menjalankan Proyek Fullstack Portal Berita

Berikut adalah langkah-langkah untuk menjalankan proyek Fullstack Portal Berita secara lengkap dan terstruktur:

1. Persiapan Software

Unduh dan instal software berikut:

Visual Studio Code: Digunakan sebagai editor kode.

XAMPP: Menyediakan server lokal yang mencakup Apache dan MySQL.

Browser: Contoh: Chrome, Firefox, atau browser lainnya.

Download semua file proyek dan simpan ke dalam folder:

C:\xampp\htdocs\fullstack_portalBerita

2. Menjalankan XAMPP

Buka XAMPP Control Panel.

Klik tombol "Start" pada bagian Apache dan MySQL untuk menjalankan server.

3. Membuat Database

Buka Command Prompt (CMD), lalu masukkan perintah berikut satu per satu:

c:
cd \xampp\mysql\bin
mysql -u root

Setelah masuk ke MySQL shell, buat database dan tabel dengan perintah berikut:

CREATE DATABASE use_db;

USE use_db;

CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

4. Menjalankan Proyek

Pastikan Apache dan MySQL pada XAMPP masih dalam keadaan aktif.

Buka browser, lalu akses URL berikut:

Halaman utama: http://localhost/Fullstack_PortalBerita/home.html

Halaman politik: http://localhost/Fullstack_PortalBerita/Politik.html

Ganti nama file terakhir sesuai dengan halaman yang ingin dibuka, misalnya home.html atau Politik.html.

Catatan Penting

Koneksi ke Database:
Pastikan file PHP Anda memiliki konfigurasi koneksi database yang benar. Biasanya, file koneksi terletak di direktori proyek, misalnya config.php. Berikut adalah contoh konfigurasi koneksi:

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "use_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

Cek Error:
Jika terjadi error, pastikan:

Database dan tabel telah dibuat dengan benar.

Semua file proyek telah diunggah ke folder htdocs di XAMPP.

Semoga berhasil! Jika ada pertanyaan atau kendala, jangan ragu untuk bertanya. 😊

