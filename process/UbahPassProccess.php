<?php
$id_user = $_SESSION['id_user'] ?? null;
if (!$id_user) {
  die('User tidak ditemukan. Pastikan sudah login.');
}

$sqlMahasiswa = "SELECT * FROM Users WHERE id_user = ?";
$stmtMahasiswa = sqlsrv_query($conn, $sqlMahasiswa, [$id_user]);
$rowMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_password = $_POST['current_password'] ?? '';
  $new_password = $_POST['new_password'] ?? '';
  $confirm_password = $_POST['confirm_password'] ?? '';

  // Validate password change
  if (!empty($new_password)) {
    // Verify current password
    $sqlVerifyPassword = "SELECT password FROM Users WHERE id_user = ?";
    $stmtVerifyPassword = sqlsrv_query($conn, $sqlVerifyPassword, [$id_user]);
    $rowPassword = sqlsrv_fetch_array($stmtVerifyPassword, SQLSRV_FETCH_ASSOC);

    if (!$rowPassword) {
      echo "<script>alert('User tidak ditemukan!');</script>";
    } elseif (!password_verify($current_password, $rowPassword['password'])) {
      echo "<script>alert('Password saat ini salah!');</script>";
    } elseif ($new_password !== $confirm_password) {
      echo "<script>alert('Password konfirmasi tidak cocok!');</script>";
    } else {
      // Hash the new password before storing
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

      $sqlUpdatePassword = "UPDATE Users SET password = ? WHERE id_user = ?";
      $paramsPassword = [$hashed_password, $id_user];
      $stmtUpdatePassword = sqlsrv_query($conn, $sqlUpdatePassword, $paramsPassword);

      if ($stmtUpdatePassword) {
        echo "<script>alert('Password berhasil diperbarui!');</script>";
      } else {
        echo "<script>alert('Gagal memperbarui password!');</script>";
      }
    }
  } else {
    echo "<script>alert('Password baru tidak boleh kosong!');</script>";
  }
}