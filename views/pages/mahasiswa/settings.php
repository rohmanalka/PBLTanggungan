<?php
include '../../../config/connection.php';
include '../../../config/dataMahasiswa.php';
include '../../../models/MahasiswaModel.php';

$id_user = $_SESSION['id_user'] ?? null; 
if (!$id_user) {
    die('User tidak ditemukan. Pastikan sudah login.');
}

$sqlMahasiswa = "SELECT * FROM Mahasiswa WHERE id_user = ?";
$stmtMahasiswa = sqlsrv_query($conn, $sqlMahasiswa, [$id_user]);
$rowMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';
    $program_studi = $_POST['program_studi'] ?? '';
    $angkatan = $_POST['angkatan'] ?? '';
    $email = $_POST['email'] ?? '';

    $sqlUpdate = "UPDATE Mahasiswa SET 
                    first_name = ?, 
                    last_name = ?, 
                    nim = ?, 
                    jurusan = ?, 
                    program_studi = ?, 
                    angkatan = ?, 
                    email = ?
                  WHERE id_user = ?";
    $params = [$first_name, $last_name, $nim, $jurusan, $program_studi, $angkatan, $email, $id_user];
    $stmtUpdate = sqlsrv_query($conn, $sqlUpdate, $params);

    if ($stmtUpdate) {
        echo "<script>alert('Data berhasil diperbarui!');</script>";
        // Refresh halaman untuk menampilkan data terbaru
        header("Refresh:0");
    } else {
        die(print_r(sqlsrv_errors(), true));
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
  <!-- css -->
</head>

<body>
  <div class="wrapper">
    <div class="main-panel">
      <!-- sidebar -->
      <?php include('../../layouts/sidebar.php') ?>
      <!-- sidebar -->

      <!-- navbar -->
      <?php include('../../layouts/header.php') ?>
      <!-- navbar -->

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h1 class="fw-bold mb-3">Settings</h1>
              <h6 class="op-7 mb-2">SimasBeta / Others / Settings</h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Edit Biodata</div>
                </div>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['first_name'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['last_name'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['nim'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['jurusan'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="program_studi">Program Studi</label>
                    <input type="text" class="form-control" id="program_studi" name="program_studi" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['program_studi'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['angkatan'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo htmlspecialchars($rowMahasiswa['email'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- footer -->
        <?php include('../../layouts/footer.php') ?>
        <!-- footer -->
      </div>
    </div>
  </div>
  <!-- js -->
  <?php include('js.php') ?>
  <!-- js -->
</body>

</html>
