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

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h1 class="fw-bold mb-3">Settings</h1>
              <h6 class="op-7 mb-2">SimasBeta / Others / Settings</h6>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Kelola Account</div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">NIM</th>
                      <th scope="col">Nama Lengkap</th>
                      <th scope="col">Jurusan</th>
                      <th scope="col">Program Studi</th>
                      <th scope="col">Username</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data Mahasiswa -->
                    <tr>
                      <th>1</th>
                      <td>2341760178</td>
                      <td>Saria Fauzani</td>
                      <td>Teknologi Informasi</td>
                      <td>DIV-SIB</td>
                      <td>2341760178</td>
                      <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#editModal1">
                          Edit
                        </button>

                        <!-- Hapus Button -->
                        <button type="button" class="btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal1">
                          Hapus
                        </button>
                      </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal1" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="edit.php" method="post">
                              <input type="hidden" name="id" value="1">
                              <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="2341760178" required>
                              </div>
                              <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="Saria Fauzani" required>
                              </div>
                              <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <input type="text" class="form-control" id="jurusan" name="jurusan" value="Teknologi Informasi" required>
                              </div>
                              <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" value="DIV-SIB" required>
                              </div>
                              <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="2341760178" required>
                              </div>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusModal1" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                            <a href="hapus.php?id=1" class="btn btn-danger">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php include('../../layouts/footer.php') ?>
    </div>
  </div>

  <!-- js -->
  <?php include('js.php') ?>
</body>

</html>