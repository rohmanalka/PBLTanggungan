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
    .b {
      color: white;
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
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Upload Berkas</h2>
              <h6 class="op-7 mb-2"><?= htmlspecialchars($dataMhs['NIM']) ?> / <?= htmlspecialchars($dataMhs['nama']) ?></h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Silahkan upload berkas tanggungan anda</div>
                  <div class="card-tools">
                    <a href="#" class="btn btn-black btn-border btn-round btn-sm me-2" style="width: 150px;">
                      <span class="btn-label">
                        <i class="fa fa-pencil"></i>
                      </span>
                      Search...
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <?php if (empty($tanggunganData)): ?>
                    <div class="alert alert-info">Tidak ada tanggungan untuk mahasiswa ini.</div>
                  <?php else: ?>
                    <table class="table align-items-center mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">ID</th>
                          <th scope="col">Tanggungan</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Projects table -->
                        <?php
                        $no = 1;
                        foreach ($tanggunganData as $data): ?>
                          <tr>
                            <th><?= $no++; ?></th>
                            <td><?= htmlspecialchars($data['id_tanggungan']); ?></td>
                            <td><?= htmlspecialchars($data['jenis_tanggungan']); ?></td>
                            <td><?= htmlspecialchars($data['keterangan']); ?></td>
                            <td>
                              <?php if ($data['status'] === 'terpenuhi'): ?>
                                <span class="badge badge-success">Terpenuhi</span>
                              <?php else: ?>
                                <!-- Button untuk membuka modal upload -->
                                <button type="button" class="b btn-primary" data-bs-toggle="modal" data-bs-target='#uploadModal<?= $data['id_tanggungan']; ?>'>
                                  Upload
                                </button>

                                <!-- Modal untuk upload file -->
                                <div class="modal fade" id="uploadModal<?= $data['id_tanggungan']; ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="../../../process/UpBerkasProcess.php" method="post" enctype="multipart/form-data">
                                          <input type="hidden" name="id_tanggungan" value="<?= $data['id_tanggungan']; ?>">
                                          <div class="mb-3">
                                            <label for="fileInput" class="form-label">Pilih Berkas</label>
                                            <input type="file" class="form-control" id="fileInput" name="file" required>
                                          </div>
                                          <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <main> -->
      <!-- <footer> -->
      <?php include('../../layouts/footer.php') ?>
      <!-- <footer> -->
    </div>
  </div>
  <!-- js -->
  <?php include('js.php') ?>
  <!-- SweetAlert script to show success or error messages -->
  <?php if (isset($_GET['message'])): ?>
    <script>
      <?php if ($_GET['message'] === 'upload_success'): ?>
        swal({
          title: "Upload Berhasil!",
          text: "Berkas Anda telah berhasil diunggah.",
          icon: "success",
          button: "OK",
        });
      <?php elseif ($_GET['message'] === 'upload_error'): ?>
        swal({
          title: "Upload Gagal!",
          text: "Terjadi kesalahan saat mengunggah berkas.",
          icon: "error",
          button: "OK",
        });
      <?php endif; ?>
    </script>
  <?php endif; ?>

  <script>
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