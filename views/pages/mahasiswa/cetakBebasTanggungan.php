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
              <h2 class="fw-bold mb-3">Cetak Bebas Tanggungan</h2>
              <h6 class="op-7 mb-2"><?= htmlspecialchars($dataMhs['NIM']) ?> / <?= htmlspecialchars($dataMhs['nama']) ?></h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Silahkan ajukan bebas tanggungan anda</div>
                  <div class="card-tools">
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <form method="GET" action="">
                    <table class="table align-items-center mb-0">
                      <tbody>
                        <!-- Projects table -->
                        <tr>
                          <td>
                            <div class="row align-items-center">
                              <!-- Filter Button -->
                              <div class="col-md-2">
                                <button type="submit" name="filter" value="belum terpenuhi" class="btn btn-primary w-100">
                                  Cek
                                </button>
                              </div>
                              <!-- Request Bebas Tanggungan Button -->
                              <div class="col-md-4">
                                <button class="btn btn-info w-100">
                                  Request Bebas Tanggungan
                                </button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>Jenis Tanggungan</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Display filtered data
                      foreach ($tanggunganData as $tanggungan) {
                        // Memastikan bahwa hanya tanggungan dengan status 'belum terpenuhi' yang ditampilkan
                        if ($filterStatus === 'belum terpenuhi' && $tanggungan['status'] === 'belum terpenuhi') {
                          echo "<tr>
                          <td>" . htmlspecialchars($tanggungan['jenis_tanggungan']) . "</td>
                          <td>" . htmlspecialchars($tanggungan['keterangan']) . "</td>
                          <td>";

                          // Menambahkan badge dengan class 'badge-danger' untuk status 'belum terpenuhi'
                          if ($tanggungan['status'] === 'belum terpenuhi') {
                            echo "<span class='badge badge-danger'>Belum Terpenuhi</span>";
                          } else {
                            echo htmlspecialchars($tanggungan['status']);
                          }

                          echo "</td></tr>";
                        }
                      }
                      ?>
                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- footer -->
      <?php include('../../layouts/footer.php') ?>
      <!-- footer -->
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