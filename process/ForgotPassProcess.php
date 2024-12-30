<?php
require '../config/connection.php'; // Include database connection and other necessary files

// Buat instance dari kelas Database
$db = new connection();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!empty($username) && !empty($new_password)) {
        // Verify username exists
        $sqlCheckUser = "SELECT id_user FROM Users WHERE username = ?";
        $stmtCheckUser = sqlsrv_query($conn, $sqlCheckUser, [$username]);
        $user = sqlsrv_fetch_array($stmtCheckUser, SQLSRV_FETCH_ASSOC);

        if ($user) {
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $sqlUpdatePassword = "UPDATE Users SET password = ? WHERE id_user = ?";
                $paramsUpdatePassword = [$hashed_password, $user['id_user']];
                $stmtUpdatePassword = sqlsrv_query($conn, $sqlUpdatePassword, $paramsUpdatePassword);

                if ($stmtUpdatePassword) {
                    echo "<script>alert('Password berhasil diperbarui!');</script>";
                } else {
                    echo "<script>alert('Gagal memperbarui password!');</script>";
                }
            } else {
                echo "<script>alert('Password konfirmasi tidak cocok!');</script>";
            }
        } else {
            echo "<script>alert('Username tidak ditemukan!');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Lupa Password</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Lupa Password</h2>
        <p>Masukkan username Anda untuk mereset password.</p>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password baru" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>

</html>
