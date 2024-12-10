<?php
session_start();
require_once '../config/connection.php'; // Pastikan path ini benar

// Buat instance dari kelas Database
$db = new connection();

// Ambil koneksi
$conn = $db->getConnection();

// Ambil data dari form login
$inputUsername = $_POST['username'];
$inputPassword = $_POST['password'];

// Cari user berdasarkan username
$query = "SELECT * FROM Users WHERE username = ?";
$params = [$inputUsername];
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    die("Query gagal: " . print_r(sqlsrv_errors(), true));
}

// Ambil data user
$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Validasi user
if ($user) {
    // Verifikasi password
    if (password_verify($inputPassword, $user['password'])) {
        // Set session berdasarkan role
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id_user'] = $user['id_user'];

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            header("Location: ../views/pages/admin/dashboard.php");
        } elseif ($user['role'] === 'mahasiswa') {
            header("Location: ../views/pages/mahasiswa/dashboard.php");
        }
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}

// Tutup koneksi dan statement
sqlsrv_free_stmt($stmt);
$db->closeConnection();
