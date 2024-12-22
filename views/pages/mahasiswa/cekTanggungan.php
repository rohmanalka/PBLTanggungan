<?php
require_once '../../../config/connection.php';
include '../../../models/MahasiswaModel.php';

$template = $model->getDataJenisTanggungan();
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

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Tanggungan Mahasiswa</h2>
              <h6 class="op-7 mb-2"><?= htmlspecialchars($dataMhs['NIM']) ?> / <?= htmlspecialchars($dataMhs['nama']) ?></h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Berikut Tanggungan yang harus dipenuhi</div>
                  <div class="card-tools">
                    <!-- Button to trigger the download modal -->
                    <button class="btn btn-black btn-border btn-round btn-sm me-3" data-bs-toggle="modal" data-bs-target="#downloadTemplateModal">
                      <span class="btn-label">
                        <i class="fa fa-download"></i>
                      </span>
                      Template Berkas
                    </button>

                    <!-- Modal for downloading the template -->
                    <div class="modal fade" id="downloadTemplateModal" tabindex="-1" aria-labelledby="downloadTemplateModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="downloadTemplateModalLabel">Unduh Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form id="templateForm">
                              <div class="mb-3">
                                <label for="jenisTanggunganDropdown" class="form-label">Pilih Jenis Tanggungan</label>
                                <select class="form-select" id="jenisTanggunganDropdown" name="jenis_tanggungan" required>
                                  <option value="">Pilih Jenis Tanggungan</option>
                                  <?php foreach ($template as $row): ?>
                                    <option value="<?= htmlspecialchars($row['id_jnsTanggungan']); ?>">
                                      <?= htmlspecialchars($row['jenis_tanggungan']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                              </div>

                              <!-- Template link will appear here based on selected jenis_tanggungan -->
                              <div id="templateLinkContainer" class="mt-3" style="display: none;">
                                <p>Anda dapat mengunduh template untuk upload berkas di bawah ini:</p>
                                <a id="downloadTemplateLink" href="#" class="btn btn-primary btn-block" download>
                                  <i class="fa fa-download"></i> Unduh Template
                                </a>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="btn-group dropdown" style="width: 100px;">
                      <button class="btn btn-black btn-border dropdown-toggle btn-round btn-sm me-4" type="button" data-bs-toggle="dropdown">
                        Filter
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="?filter=terpenuhi">Terpenuhi</a></li>
                        <li><a class="dropdown-item" href="?filter=belum terpenuhi">Belum Terpenuhi</a></li>
                        <li><a class="dropdown-item" href="?">Semua</a></li>
                      </ul>
                    </div>
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
                          <th scope="col">Tanggungan</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Status</th>
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
                            <td><?= htmlspecialchars($data['jenis_tanggungan']); ?></td>
                            <td><?= htmlspecialchars($data['keterangan']); ?></td>
                            <td>
                              <?php if ($data['status'] === 'terpenuhi'): ?>
                                <span class="badge badge-success">Terpenuhi</span>
                              <?php elseif ($data['status'] === 'pending'): ?>
                                <span class="badge badge-info">Pending</span>
                              <?php else: ?>
                                <span class="badge badge-danger">Belum Terpenuhi</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($data['status'] !== 'terpenuhi'): ?>
                                <!-- Button for opening the upload modal -->
                                <button type="button" class="b btn-primary text-white" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $data['id_tanggungan'] ?>">
                                  Upload
                                </button>
                              <?php endif; ?>

                              <?php if ($data['status'] === 'terpenuhi' || !empty($data['berkas'])): ?>
                                <!-- Button for preview -->
                                <button type="button" class="b btn-info text-white" data-bs-toggle="modal" data-bs-target="#previewModal<?= $data['id_tanggungan'] ?>">
                                  <i class="fa fa-eye"></i>
                                </button>
                              <?php endif; ?>

                              <!-- Modal for Upload -->
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
                                          <label for="fileInput" class="form-label">Pilih Berkas (PDF, JPG)</label>
                                          <input type="file" class="form-control" id="fileInput" name="file" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Modal for Preview -->
                              <div class="modal fade" id="previewModal<?= $data['id_tanggungan'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Preview File</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <?php if (!empty($data['berkas'])): ?>
                                        <?php $fileType = strtolower(pathinfo($data['berkas'], PATHINFO_EXTENSION)); ?>
                                        <?php
                                        $fileUrl = "../../../upload/berkasMhs/" . htmlspecialchars($data['berkas']);
                                        $fileUrlWithTimestamp = $fileUrl . "?v=" . time();
                                        ?>
                                        <?php if ($fileType === 'pdf'): ?>
                                          <iframe src="<?= $fileUrlWithTimestamp ?>" width="100%" height="400px"></iframe>
                                        <?php else: ?>
                                          <img src="<?= $fileUrlWithTimestamp ?>" alt="File Preview" class="img-fluid">
                                        <?php endif; ?>
                                      <?php else: ?>
                                        <p>Tidak ada file untuk ditampilkan.</p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      </tbody>
                    </table>
                    <div class="text-center mt-4" style="margin-bottom: 20px;">
                      <?php
                      // Cek apakah semua mahasiswa telah memenuhi tanggungan
                      $semuaTanggunganTerpenuhi = true;
                      foreach ($tanggunganData as $mahasiswa) {
                        if ($mahasiswa['status'] !== 'terpenuhi') {
                          $semuaTanggunganTerpenuhi = false;
                          break;
                        }
                      }
                      ?>
                      <button
                        class="btn btn-primary"
                        <?= $semuaTanggunganTerpenuhi ? '' : 'disabled' ?>
                        onclick="window.location.href='../../../process/PDFProcess.php';">
                        Download Surat Bebas Tanggungan
                      </button>
                    </div>
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
    document.getElementById('jenisTanggunganDropdown').addEventListener('change', function() {
      var selectedId = this.value;
      var templateContainer = document.getElementById('templateLinkContainer');
      var downloadLink = document.getElementById('downloadTemplateLink');

      // Hide the template link container initially
      templateContainer.style.display = 'none';

      // If a valid ID is selected, find the corresponding template
      if (selectedId) {
        var template = <?php echo json_encode($template); ?>;
        var selectedTemplate = template.find(function(item) {
          return item.id_jnsTanggungan == selectedId;
        });

        // If the selected type has a template, show the download link
        if (selectedTemplate && selectedTemplate.template) {
          downloadLink.href = '../../../upload/template/' + selectedTemplate.template;
          templateContainer.style.display = 'block'; // Show the link container
        }
      }
    });
  </script>
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