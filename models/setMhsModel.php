<?php
require_once '../../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_user = $_POST['id_user']; // ID pengguna
    $currentPassword = $_POST['current_password'] ?? ''; // Password lama yang dimasukkan pengguna
    $newPassword = $_POST['new_password'] ?? ''; // Password baru

    // Query untuk mendapatkan data pengguna berdasarkan id_user
    $sql = "SELECT id_user, username, password FROM Users WHERE id_user = ?";
    $stmt = sqlsrv_query($conn, $sql, array($id_user));

    // Cek apakah query berhasil dan pengguna ditemukan
    if ($stmt) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Cek apakah pengguna ditemukan
        if ($row) {
            // Ambil hash password dari database
            $hashedPasswordFromDB = $row['password'];

            // Verifikasi password yang dimasukkan dengan password yang di-hash
            if (password_verify($currentPassword, $hashedPasswordFromDB)) {
                // Password lama cocok, update dengan password baru

                if (!empty($newPassword)) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update password baru di database
                    $sqlUpdate = "UPDATE Users SET password = ? WHERE id_user = ?";
                    $stmtUpdate = sqlsrv_query($conn, $sqlUpdate, array($hashedNewPassword, $id_user));

                    if ($stmtUpdate) {
                        echo "<script>alert('Password berhasil diperbarui!'); window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
                    } else {
                        die(print_r(sqlsrv_errors(), true));
                    }
                } else {
                    echo "Password baru tidak boleh kosong!";
                }
            } else {
                // Password lama tidak cocok
                echo "Password lama salah!";
            }
        } else {
            echo "Pengguna tidak ditemukan!";
        }
    } else {
        die(print_r(sqlsrv_errors(), true));
    }
}
?>
