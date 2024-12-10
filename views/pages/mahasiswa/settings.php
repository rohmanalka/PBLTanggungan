<?php
require_once '../../../config/connection.php';
include '../../../models/MahasiswaModel.php';
include '../../../process/UbahPassProcess.php'
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
                <form action="settings.php" method="POST">
                  <input type="hidden" name="id_mhs" value="<?php echo htmlspecialchars($rowMahasiswa['id_mhs'] ?? ''); ?>">
                  <!-- Password Saat Ini -->
                  <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" class="form-control" id="current_password" name="current_password"
                      placeholder="Masukkan password saat ini">
                  </div>
                  <!-- Password Baru -->
                  <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control" id="new_password" name="new_password"
                      placeholder="Masukkan password baru">
                  </div>
                  <!-- Konfirmasi Password Baru -->
                  <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                      placeholder="Konfirmasi password baru">
                  </div>
                  <!-- Tombol Submit -->
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
  <script>
    // Tombol Logout dengan ID #logout
    $("#out").click(function(e) {
      // SweetAlert untuk konfirmasi
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan log out!",
        icon: "warning",
        buttons: {
          cancel: {
            text: "Cancel",
            visible: true,
            className: "btn btn-danger",
          },
          confirm: {
            text: "Yes, log out",
            className: "btn btn-success",
          },
        },
      }).then((willLogout) => {
        if (willLogout) {
          // Redirect ke halaman logout
          window.location.href = "../../../process/logoutProcess.php";
        }
      });
    });
  </script>
  <!-- js -->
</body>

</html>