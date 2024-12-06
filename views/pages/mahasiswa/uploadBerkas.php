<?php
include '../../../config/connection.php';
include '../../../config/dataMahasiswa.php';
include '../../../models/MahasiswaModel.php';

// Check if file is uploaded and processed correctly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = "../../../uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate file extension
    if ($fileType !== 'pdf') {
        echo "Sorry, only PDF files are allowed.";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Save the file path in the database
            $id_tanggungan = $_POST['id_tanggungan'];
            $query = "UPDATE tanggungan SET file_path = '$targetFilePath' WHERE id_tanggungan = '$id_tanggungan'";
            mysqli_query($conn, $query);
        } else {
            echo "Sorry, there was an error uploading your file.";
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
              <h2 class="fw-bold mb-3">Upload Berkas</h2>
              <h6 class="op-7 mb-2"><?php echo $nim ?> / <?php echo $nama ?></h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Silahkan upload berkas tanggungan anda</div>
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
                          <th scope="col">Berkas</th> 
                          <th scope="col">Aksi</th>
                          <th scope="col">Preview</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($tanggunganData as $data): ?>
                          <tr>
                            <th><?= $no++; ?></th>
                            <td><?= htmlspecialchars($data['id_tanggungan']); ?></td>
                            <td><?= htmlspecialchars($data['jenis_tanggungan']); ?></td>
                            <td><?= htmlspecialchars($data['keterangan']); ?></td>
                            <td>
                              <!-- Template Download Button -->
                              <a href="path_to_template_file.pdf" download class="btn btn-secondary btn-sm">
                                <i class="fa fa-download"></i> Download Template
                              </a>
                            </td>
                            <td>
                              <?php if ($data['status'] === 'terpenuhi'): ?>
                                <span class="badge badge-success">Terpenuhi</span>
                              <?php else: ?>
                                <!-- Button to open the upload modal -->
                                <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target='#uploadModal<?= $data['id_tanggungan']; ?>'>
                                  Upload
                                </button>

                                <!-- Modal for uploading file -->
                                <div class="modal fade" id="uploadModal<?= $data['id_tanggungan']; ?>" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                          <input type="hidden" name="id_tanggungan" value="<?= $data['id_tanggungan']; ?>">
                                          <div class="mb-3">
                                            <label for="fileInput" class="form-label">Pilih Berkas (PDF Only)</label>
                                            <input type="file" class="form-control" id="fileInput" name="file" accept=".pdf" required>
                                          </div>
                                          <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if (!empty($data['file_path'])): ?>
                                <!-- Preview Button -->
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal<?= $data['id_tanggungan']; ?>">
                                  <i class="fa fa-eye"></i> Preview
                                </button>

                                <!-- Modal Preview -->
                                <div class="modal fade" id="previewModal<?= $data['id_tanggungan']; ?>" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="previewModalLabel">Preview Berkas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <?php 
                                          $filePath = $data['file_path'];
                                          $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                          if ($fileExt === 'pdf') {
                                            // Preview PDF with better styling
                                            echo "<iframe src='$filePath' width='100%' height='500' frameborder='0'></iframe>";
                                          } else {
                                            echo "<div class='alert alert-warning'>Pratinjau hanya tersedia untuk file PDF</div>";
                                          }
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php else: ?>
                                <span class="text-muted">Belum ada berkas</span>
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

      <?php include('../../layouts/footer.php') ?>
    </div>
  </div>

  <!-- js -->
  <?php include('js.php') ?>
  <!-- js -->
</body>

</html>