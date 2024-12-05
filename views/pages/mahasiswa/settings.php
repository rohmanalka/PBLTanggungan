<?php
include '../../../config/connection.php';
include '../../../config/dataMahasiswa.php';
include '../../../models/MahasiswaModel.php';
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
                <form action="../../../models/settingModel.php" method="POST">
                  <input type="hidden" name="id_mhs" value="<?php echo htmlspecialchars($rowMahasiswa['id_mhs'] ?? ''); ?>">

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
                    <label for="prodi">Program Studi</label>
                    <input type="text" class="form-control" id="prodi" name="prodi"
                      value="<?php echo htmlspecialchars($rowMahasiswa['prodi'] ?? ''); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan"
                      value="<?php echo htmlspecialchars($rowMahasiswa['angkatan'] ?? ''); ?>" required>
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