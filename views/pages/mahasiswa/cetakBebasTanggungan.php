<?php
include '../../../config/connection.php';
include '../../../config/getData.php';
include '../../../models/cekModel.php';
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
              <h2 class="fw-bold mb-3">Dashboard</h2>
              <h6 class="op-7 mb-2"><?php echo $nim ?> / <?php echo $nama ?></h6>
            </div>
          </div>

          <!-- Tabel -->
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Biodata Mahasiswa</div>
                </div>
              </div>
              <div class="card-body p-0">
              <div class="row row-demo-grid" style="justify-content: center; margin-top: 30px;">
                  <div class="col-6 col-md-3">
                    <div class="card">
                      <div class="card-body" style="background-color: blanchedalmond;"><code>Nama</code></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><code>Lutfi mahardika</code></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include('../../layouts/footer.php') ?>
    </div>
  </div>

  <?php include('js.php') ?>
</body>

</html>