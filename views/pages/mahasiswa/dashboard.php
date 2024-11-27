<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: ../index.php");
  exit();
}

// Redirect admin jika mencoba mengakses halaman mahasiswa
if ($_SESSION['role'] === 'admin') {
  header("Location: ../admin/dashboard.php");
  exit();
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

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Dashboard</h2>
              <h6 class="op-7 mb-2">2341760055 / Muhammad Rohman Al Kautsar</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-folder-open"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Tanggungan</p>
                        <h4 class="card-title">6</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
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
                        <p class="card-category">Selesai</p>
                        <h4 class="card-title">4</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
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
                        <p class="card-category">Belum Terpenuhi</p>
                        <h4 class="card-title">2</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div
                        class="icon-big text-center icon-secondary bubble-shadow-small">
                        <i class="fas fa-pen"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Status</p>
                        <h4 class="card-title">Belum</h4>
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
                  <div class="card-title">Tanggungan Mahasiswa</div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggungan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>1</th>
                        <td>Bebas Kompensasi</td>
                        <td>Surat Kompensasi Presensi</td>
                        <td>
                          <span class="badge badge-success">Completed</span>
                        </td>
                      </tr>
                      <tr>
                        <th>2</th>
                        <td>Laporan Magang</td>
                        <td>File Laporan Magang</td>
                        <td>
                          <span class="badge badge-success">Completed</span>
                        </td>
                      </tr>
                      <tr>
                        <th>3</th>
                        <td>Laporam Skripsi</td>
                        <td>File Laporan Skripsi</td>
                        <td>
                          <span class="badge badge-success">Completed</span>
                        </td>
                      </tr>
                      <tr>
                        <th>4</th>
                        <td>TOEIC</td>
                        <td>Sertifikat TOEIC minimal 350</td>
                        <td>
                          <span class="badge badge-success">Completed</span>
                        </td>
                      </tr>
                      <tr>
                        <th>5</th>
                        <td>Tanggungan Perpustakaan</td>
                        <td>Surat Bebas Tanggungan Perpus</td>
                        <td>
                          <span class="badge badge-success">Completed</span>
                        </td>
                      </tr>
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