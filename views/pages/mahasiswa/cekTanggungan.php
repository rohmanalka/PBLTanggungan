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
              <h6 class="op-7 mb-2">2341760055 / Muhammad Rohman Al Kautsar</h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Berikut Tanggungan yang harus dipenuhi</div>
                    <div class="card-tools">
                        <a href="#" class="btn btn-black btn-border btn-round btn-sm me-2" style="width: 150px;">
                          <span class="btn-label">
                            <i class="fa fa-pencil"></i>
                          </span>
                          Search...
                        </a>
                    <div class="btn-group dropdown" style="width: 150px;">
                        <button class="btn btn-black btn-border dropdown-toggle btn-round btn-sm me-2" type="button" data-bs-toggle="dropdown">
                          Filter..
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a class="dropdown-item" href="#">Terpenuhi</a>
                            <a class="dropdown-item" href="#">Belum Terpenuhi</a>
                          </li>
                        </ul>
                      </div>
                    </div>
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