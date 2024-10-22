<?php
session_start();

// Koneksi ke database
$host = 'localhost'; // Nama host database
$dbUsername = 'root'; // Username database
$dbPassword = ''; // Password database
$dbName = 'sistem_login'; // Nama database

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Cek koneksi ke database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna di database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Mengecek apakah pengguna ditemukan
if ($result->num_rows > 0) {
    // Login berhasil, simpan sesi pengguna
    $_SESSION['username'] = $username;
    header("Location: dashboard.php"); // Arahkan ke halaman dashboard
} else {
    // Login gagal, kembali ke halaman login
    echo "<script>alert('Username atau password salah!'); window.location.href = 'index.html';</script>";
}

// Tutup koneksi
$conn->close();
?>
