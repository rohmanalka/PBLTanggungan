<?php
session_start();
require_once '../config/connection.php';

// Buat instance dari kelas Database
$db = new connection();
$conn = $db->getConnection();

try {
    // Ambil data dari form login
    $inputUsername = trim($_POST['username']);
    $inputPassword = $_POST['password'];

    // Validasi input
    if (empty($inputUsername) || empty($inputPassword)) {
        throw new Exception("Username atau password tidak boleh kosong.");
    }

    // Cari user berdasarkan username
    $query = "SELECT * FROM Users WHERE username = ?";
    $params = [$inputUsername];
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        throw new Exception("Kesalahan server. Silakan coba lagi nanti.");
    }

    // Ambil data user
    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    // Validasi user dan verifikasi password
    if ($user && password_verify($inputPassword, $user['password'])) {
        // Set session berdasarkan role
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id_user'] = $user['id_user'];

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            header("Location: ../views/pages/admin/dashboard.php");
            exit;
        } elseif ($user['role'] === 'mahasiswa') {
            header("Location: ../views/pages/mahasiswa/dashboard.php");
            exit;
        }
    } else {
        throw new Exception("Username atau password salah.");
    }
} catch (Exception $e) {
    // Tampilkan pesan error secara aman
    echo htmlspecialchars($e->getMessage());
} finally {
    // Tutup koneksi dan statement
    if (isset($stmt)) {
        sqlsrv_free_stmt($stmt);
    }
    $db->closeConnection();
}
?>
