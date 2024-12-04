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
              <h2 class="fw-bold mb-3">Berkas Akademik</h2>
              <h6 class="op-7 mb-2"><?php echo $nip ?> / <?php echo $nama ?></h6>
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
                        <!-- Projects table -->
                          <tr>
                            <th>1</th>
                            <td>Ivan Rizal Ahmadi</td>
                            <td>UKT</td>
                            <td>Surat Bebas UKT</td>
                            <td>
                                <button type="button" class="btn-primary">
                                  Lihat
                                </button>
                                <button type="button" class="btn-success">
                                  Verifikasi
                                </button>
                                <button type="button" class="btn-danger">
                                  Tolak
                                </button>
                            </td>
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