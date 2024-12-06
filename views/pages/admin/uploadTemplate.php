<?php
include '../../../config/connection.php';
include '../../../models/AdminModel.php';
include '../../../config/dataAdmin.php';
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
      <?php include('../../layouts/headerAdmin.php') ?>
      <!-- navbar -->

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Upload Template Surat</h2>
              <h6 class="op-7 mb-2"><?php echo $nip ?> / <?php echo $nama ?></h6>
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
                          <th scope="col">Nama File</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Projects table -->
                        <?php
            $tanggunganData = [
              ['id_tanggungan' => 1, 'nama_file' => 'Bebas Kompensasi', 'status' => 'belum'],
              ['id_tanggungan' => 2, 'nama_file' => 'Laporan Magang', 'status' => 'belum'],
              ['id_tanggungan' => 3, 'nama_file' => 'Laporan Skripsi', 'status' => 'belum'],
              ['id_tanggungan' => 4, 'nama_file' => 'TOEIC', 'status' => 'belum'],
              ['id_tanggungan' => 5, 'nama_file' => 'Perpustakaan', 'status' => 'belum'],
              ['id_tanggungan' => 6, 'nama_file' => 'Bebas UKT', 'status' => 'belum']
            ];

            foreach ($tanggunganData as $index => $data) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($data['nama_file']) ?></td>
                <td>
                  <button type="button" class="btn-danger" data-bs-toggle="modal" data-bs-target='#uploadModal<?= $data['id_tanggungan']; ?>'>
                    Edit File
                  </button>
                  <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $data['id_tanggungan'] ?>">
                    Upload
                  </button>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="editModal<?= $data['id_tanggungan'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit File</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../../../editFileModel.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_tanggungan" value="<?= $data['id_tanggungan']; ?>">
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
              <div class="modal fade" id="uploadModal<?= $data['id_tanggungan']; ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../../../models/UploadModel.php" method="post" enctype="multipart/form-data">
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
                <?php endforeach; ?>
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
  <!-- js -->
</body>

</html>