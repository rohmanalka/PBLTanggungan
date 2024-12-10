<?php
require_once '../../../config/connection.php';
include '../../../models/MahasiswaModel.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- css -->
  <?php include('css.php') ?>
  <style>
    .bio {
      height: 50px;
      margin-top: -10px;
      background-color: #F2F4F9;
    }

    .foto {
      height: 330px;
      margin-top: -10px;
      background-color: #F2F4F9;
    }

    .profile {
      width: 200px;
      height: 230px;
      overflow: hidden;
      border-radius: 10px;
    }

    .avatar-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .value {
      padding-left: 100px;
    }

    .title {
      display: inline-block;
      width: 130px;
    }

    .btn {
      margin-top: 5px;
    }
  </style>
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

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h1 class="fw-bold mb-3">Account</h1>
              <h6 class="op-7 mb-2">SimasBeta / Others / Account</h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Biodata Mahasiswa</div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="row row-demo-grid" style="justify-content: center; margin-top: 30px;">
                  <div class="col-md-4 text-center">
                    <div class="foto card">
                      <div class="card-body" style="margin: 10px;">
                        <div class="profile avatar avatar-xxl">
                          <img src="<?php echo htmlspecialchars($foto); ?>" alt="Foto Profil" class="avatar-img" />
                        </div>
                        <div class="b">
                          <span class="mhs">FOTO PROFILE</span>
                        </div>
                        <div class="upload">
                          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $dataMhs['id_mhs'] ?>">
                            Change Profile
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="bio card">
                      <div class="card-body">
                        <span class="title">NAMA LENGKAP</span>
                        <span class="value"><?= htmlspecialchars($dataMhs['nama']) ?></span>
                      </div>
                    </div>
                    <div class="bio card">
                      <div class="card-body">
                        <span class="title">NIM</span>
                        <span class="value"><?= htmlspecialchars($dataMhs['NIM']) ?></span>
                      </div>
                    </div>
                    <div class="bio card">
                      <div class="card-body">
                        <span class="title">JURUSAN</span>
                        <span class="value"><?= htmlspecialchars($dataMhs['jurusan']) ?></span>
                      </div>
                    </div>
                    <div class="bio card">
                      <div class="card-body">
                        <span class="title">PROGRAM STUDI</span>
                        <span class="value"><?= htmlspecialchars($dataMhs['prodi']) ?></span>
                      </div>
                    </div>
                    <div class="bio card">
                      <div class="card-body">
                        <span class="title">ANGKATAN</span>
                        <span class="value"><?= htmlspecialchars($dataMhs['angkatan']) ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <main> -->
      <!-- Modal Upload -->
      <div class="modal fade" id="uploadModal<?= $dataMhs['id_mhs']; ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Profile</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../../../process/UpFotoProcess.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_mhs" value="<?= $dataMhs['id_mhs']; ?>">
                <div class="mb-3">
                  <label for="fileInput" class="form-label">Pilih Profile</label>
                  <input type="file" class="form-control" id="fileInput" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- <footer> -->
    <?php include('../../layouts/footer.php') ?>
    <!-- <footer> -->
  </div>
  <!-- js -->
  <?php include('js.php') ?>
  <?php if (isset($_GET['message'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Check the message parameter
        var message = '<?php echo $_GET['message']; ?>';
        var error = '<?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?>';

        if (message === 'upload_success') {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Profile berhasil di update.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            window.location.href = 'account.php'; // Optionally redirect after success
          });
        } else if (message === 'upload_failed') {
          var errorMessage = 'Unknown error occurred.';
          if (error === 'invalid_file_type') {
            errorMessage = 'Only JPG and JPEG files are allowed.';
          } else if (error === 'move_failed') {
            errorMessage = 'Failed to move the uploaded file.';
          } else if (error === 'query_error') {
            errorMessage = 'Database update failed.';
          } else if (error === 'no_file_uploaded') {
            errorMessage = 'No file was uploaded.';
          }

          Swal.fire({
            title: 'Gagal!',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      });
    </script>
  <?php endif; ?>

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