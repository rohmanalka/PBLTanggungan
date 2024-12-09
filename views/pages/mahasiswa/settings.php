<?php
include '../../../config/connection.php';
include '../../../models/MahasiswaModel.php';
include '../../../models/setMhsModel.php'
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
                  <div class="card-title">Edit Password</div>
                </div>
              </div>
              <div class="card-body">
                <form action="settings.php" method="POST">
                  <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($row['id_user'] ?? ''); ?>">

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['username'] ?? ''); ?>" required readonly>
                  </div>

                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                  </div>

                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Update Password</button>
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
          window.location.href = "../../../controllers/logout.php";
        }
      });
    });
  </script>
  <!-- js -->
</body>

</html>