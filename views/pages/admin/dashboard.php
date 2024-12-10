<?php
require_once '../../../config/connection.php';
include '../../../models/AdminModel.php';

$id_jnsTanggungan = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$pendingTanggungan = $model->getPendingTanggungan($id_jnsTanggungan);
$uploadDir = "../../../upload/berkasMhs/"
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
              <h2 class="fw-bold mb-3">Dashboard</h2>
              <h6 class="op-7 mb-2"><?= htmlspecialchars($dataAdmin['nip']) ?> / <?= htmlspecialchars($dataAdmin['nama']) ?></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Jumlah Tanggungan Mahasiswa</p>
                        <h4 class="card-title">10</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fas fa-check"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Sudah Terverifikasi</p>
                        <h4 class="card-title">14</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-exclamation"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Belum Terverifikasi</p>
                        <h4 class="card-title">6</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Berikut berkas tanggungan akademik yang harus diverifikasi</div>
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
                  <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Tanggungan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($pendingTanggungan)): ?>
                        <?php foreach ($pendingTanggungan as $index => $tanggungan): ?>
                          <tr>
                            <th><?= $index + 1 ?></th>
                            <td><?= htmlspecialchars($tanggungan['nama']) ?></td>
                            <td><?= htmlspecialchars($tanggungan['jenis_tanggungan']) ?></td>
                            <td><?= htmlspecialchars($tanggungan['keterangan']) ?></td>
                            <td>
                              <!-- Verifikasi button -->
                              <form method="POST" action="../../../process/VerifyProcess.php" style="display:inline;">
                                <input type="hidden" name="id_tanggungan" value="<?= $tanggungan['id_tanggungan'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="button" class="b btn-success" onclick="openVerificationModal('<?= htmlspecialchars($tanggungan['nama']) ?>', '<?= htmlspecialchars($tanggungan['NIM']) ?>', '<?= htmlspecialchars($tanggungan['berkas']) ?>', '<?= $tanggungan['id_tanggungan'] ?>')">Verifikasi</button>
                              </form>
                            </td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="verificationModalLabel">Verifikasi Tanggungan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p><strong>Nama Mahasiswa:</strong> <span id="studentName"></span></p>
                                  <p><strong>NIM:</strong> <span id="studentNim"></span></p>
                                  <p><strong>Nama Berkas:</strong> <span id="fileName"></span></p>
                                  <div id="filePreviewContainer" style="display: none;">
                                    <h6>Preview Berkas:</h6>
                                    <iframe id="filePreview" style="width: 100%; height: 300px;" frameborder="0"></iframe>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <form id="verificationForm" method="POST" action="../../../process/VerifyProcess.php">
                                    <input type="hidden" name="id_tanggungan" id="modalIdTanggungan">
                                    <input type="hidden" id="actionInput" name="action" value="approve">
                                    <button type="button" class="btn btn-success" id="approveButton">Verifikasi</button>
                                    <button type="button" class="btn btn-danger" id="rejectButton">Tolak</button>
                                  </form>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center">Tidak ada data tanggungan pending</td>
                        </tr>
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

    function viewFile(filePath) {
      // Menampilkan file tergantung jenisnya
      var fileExtension = filePath.split('.').pop().toLowerCase();

      if (fileExtension == 'jpg' || fileExtension == 'jpeg') {
        // Tampilkan gambar
        var imageWindow = window.open(filePath, '_blank');
        imageWindow.focus();
      } else if (fileExtension == 'pdf') {
        // Tampilkan PDF dalam modal atau iframe
        var pdfWindow = window.open(filePath, '_blank');
        pdfWindow.focus();
      } else {
        alert('Unsupported file type');
      }
    }

    let currentIdTanggungan; // Global variable to store the current ID

    function openVerificationModal(name, nim, file, idTanggungan) {
      // Set the modal data
      document.getElementById('studentName').innerText = name;
      document.getElementById('studentNim').innerText = nim;
      document.getElementById('fileName').innerText = file;

      // Set the ID for the form and the global variable
      document.getElementById('modalIdTanggungan').value = idTanggungan;
      currentIdTanggungan = idTanggungan; // Store the ID in the global variable

      // Show the file preview if it exists
      if (file) {
        document.getElementById('filePreviewContainer').style.display = 'block';
        document.getElementById('filePreview').src = '<?= $uploadDir ?>' + file;
      } else {
        document.getElementById('filePreviewContainer').style.display = 'none';
      }

      // Show the modal
      $('#verificationModal').modal('show');
    }

    // Handle approve button click
    document.getElementById('approveButton').onclick = function() {
      document.getElementById('actionInput').value = 'approve';
      // SweetAlert confirmation for approval
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan memverifikasi tanggungan ini!",
        icon: "warning",
        buttons: {
          cancel: {
            text: "Batal",
            visible: true,
            className: "btn btn-danger",
          },
          confirm: {
            text: "Ya, Verifikasi",
            className: "btn btn-success",
          },
        },
      }).then((willApprove) => {
        if (willApprove) {
          // Show success message
          swal("Berkas telah terverifikasi", {
            icon: "success",
            buttons: false, // Disable the button
          });

          // Delay the form submission
          setTimeout(function() {
            document.getElementById('verificationForm').submit();
          }, 2000); // Delay for 2000 milliseconds (2 seconds)
        }
      });
    };

    // Handle reject button click
    document.getElementById('rejectButton').onclick = function() {
    document.getElementById('actionInput').value = 'reject';
      // SweetAlert confirmation for rejection
      swal({
        title: "Apakah Anda Yakin?",
        text: "Anda akan menolak tanggungan ini!",
        icon: "warning",
        buttons: {
          cancel: {
            text: "Batal",
            visible: true,
            className: "btn btn-danger",
          },
          confirm: {
            text: "Ya, Tolak",
            className: "btn btn-success",
          },
        },
      }).then((willReject) => {
        if (willReject) {
          // Show reject message
          swal("Berkas ditolak", {
            icon: "error",
            buttons: false, // Disable the button
          });
          // Set the action to reject
          setTimeout(function() {
            document.getElementById('modalIdTanggungan').value = currentIdTanggungan; // Use the global variable
            document.getElementById('verificationForm').submit();
          }, 2000); // Delay for 2000 milliseconds (2 seconds)
        }
      });
    };
  </script>
  <!-- js -->
</body>

</html>