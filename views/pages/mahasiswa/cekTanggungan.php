<?php
include '../../../config/connection.php';
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
                    <div class="btn-group dropdown" style="width: 150px;">
                      <button class="btn btn-black btn-border dropdown-toggle btn-round btn-sm me-2" type="button" data-bs-toggle="dropdown">
                        Sort By
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
          window.location.href = "../../../controllers/logout.php";
        }
      });
    });
  </script>
  <!-- js -->
</body>

</html>