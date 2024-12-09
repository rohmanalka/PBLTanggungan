<?php
include '../../../config/connection.php';
include '../../../models/AdminModel.php';
include '../../../process/UpTemplateProcess.php';
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
      <?php include('../../layouts/headerAdmin.php') ?>
      <!-- navbar -->

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Upload Template Surat</h2>
              <h6 class="op-7 mb-2"><?= htmlspecialchars($dataAdmin['nip']) ?> / <?= htmlspecialchars($dataAdmin['nama']) ?></h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Daftar Template Surat</div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Tanggungan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Projects table -->
                      <?php
                      $no = 1;
                      foreach ($tanggungan as $data) {  // Iterating through the data
                      ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= htmlspecialchars($data['jenis_tanggungan']) ?></td>
                          <td><?= htmlspecialchars($data['keterangan']) ?></td>
                          <td>
                            <button type="button" class="b btn-danger" data-bs-toggle="modal" data-bs-target='#uploadModal<?= $data['id_jnsTanggungan']; ?>'>
                              Edit File
                            </button>
                            <button type="button" class="b btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $data['id_jnsTanggungan'] ?>">
                              Upload
                            </button>
                          </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal<?= $data['id_jnsTanggungan'] ?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit File</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="../../../models/editFileModel.php" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="id_jnsTanggungan" value="<?= $data['id_jnsTanggungan']; ?>">
                                  <div class="mb-3">
                                    <label for="fileInput" class="form-label">Pilih File Baru</label>
                                    <input type="file" class="form-control" id="fileInput" name="file" required>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Upload -->
                        <div class="modal fade" id="uploadModal<?= $data['id_jnsTanggungan']; ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="uploadTemplate.php" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="id_jnsTanggungan" value="<?= $data['id_jnsTanggungan']; ?>">
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
                      <?php } ?>
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