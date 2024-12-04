<?php
include '../../../config/connection.php';
include '../../../config/dataMahasiswa.php';
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

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h1 class="fw-bold mb-3">Account</h1>
              <h6 class="op-7 mb-2">SimasBeta / Others / Account</h6>
            </div>
          </div>
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
                      <div class="card-body"><span>NAMA LENGKAP</span></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><span><?php echo $nama ?></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="row row-demo-grid" style="justify-content: center;">
                  <div class="col-6 col-md-3">
                    <div class="card">
                      <div class="card-body"><span>NIM</span></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><span><?php echo $nim ?></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="row row-demo-grid" style="justify-content: center;">
                  <div class="col-6 col-md-3">
                    <div class="card">
                      <div class="card-body"><span>JURUSAN</span></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><span><?php echo $jurusan ?></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="row row-demo-grid" style="justify-content: center;">
                  <div class="col-6 col-md-3">
                    <div class="card">
                      <div class="card-body"><span>PROGRAM STUDI</span></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><span><?php echo $prodi ?></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="row row-demo-grid" style="justify-content: center;">
                  <div class="col-6 col-md-3">
                    <div class="card">
                      <div class="card-body"><span>ANGKATAN</span></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body"><span><?php echo $angkatan ?></span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <main> -->

        </div>
        <!-- <footer> -->
        <?php include('../../layouts/footer.php') ?>
        <!-- <footer> -->
      </div>
      <!-- js -->
      <?php include('js.php') ?>
      <!-- js -->
</body>

</html>