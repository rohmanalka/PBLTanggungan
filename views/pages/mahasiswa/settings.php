<?php
include '../../../config/connection.php';
include '../../../config/dataMahasiswa.php';
include '../../../models/MahasiswaModel.php';

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

        if (!password_verify($current_password, $rowPassword['password'])) {
            echo "<script>alert('Password saat ini salah!');</script>";
        } elseif ($new_password !== $confirm_password) {
            echo "<script>alert('Password konfirmasi tidak cocok!');</script>";
        } else {
            // Hash the new password before storing
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            $sqlUpdatePassword = "UPDATE Users SET password = ? WHERE id_user = ?";
            $paramsPassword = [$hashed_password, $id_user];
            $stmtUpdatePassword = sqlsrv_query($conn, $sqlUpdatePassword, $paramsPassword);

            if (!$stmtUpdatePassword) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- css -->
  <?php include('css.php') ?>
</head>
<body>
  <div class="wrapper">
    <div class="main-panel">
      <!-- sidebar -->
      <?php include('../../layouts/sidebar.php') ?>
      <!-- navbar -->
      <?php include('../../layouts/header.php') ?>

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h1 class="fw-bold mb-3">Settings Profile</h1>
              <h6 class="op-7 mb-2">SimasBeta / Others / Settings Profile</h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Perbarui Password</div>
                </div>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" 
                           placeholder="Masukkan password saat ini">
                  </div>
                  <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" 
                           placeholder="Masukkan password baru">
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                           placeholder="Konfirmasi password baru">
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- footer -->
        <?php include('../../layouts/footer.php') ?>
      </div>
    </div>
  </div>
  <!-- js -->
  <?php include('js.php') ?>
</body>
</html>