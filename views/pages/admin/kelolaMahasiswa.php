<?php
require_once '../../../config/connection.php';
include '../../../models/AdminModel.php';
include '../../../models/setAdminModel.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- css -->
  <?php include('css.php') ?>
  <style>
    .b {
      color: white;
    }
  </style>
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
              <h6 class="op-7 mb-2">SimasBeta / Others / Settings / Kelola Mahasiswa</h6>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Kelola Account Mahasiswa</div>
                  <div class="card-tools">
                    <!-- Tombol untuk membuka modal -->
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal">
                      <span class="btn-label">
                        <i class="fa fa-plus"></i>
                      </span>
                      Tambah Data
                    </button>
                  </div>
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
                      <th scope="col">Prodi</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($datamahasiswa as $index => $mahasiswa) : ?>
                      <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($mahasiswa['NIM']) ?></td>
                        <td><?= htmlspecialchars($mahasiswa['nama']) ?></td>
                        <td><?= htmlspecialchars($mahasiswa['jurusan']) ?></td>
                        <td><?= htmlspecialchars($mahasiswa['prodi']) ?></td>
                        <td>
                          <!-- Tombol Edit dengan ikon -->
                          <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $index + 1 ?>">
                            <i class="fa fa-edit text-white"></i> <!-- Ikon edit -->
                          </button>

                          <!-- Form Hapus dengan ikon -->
                          <form id="deleteForm<?= $index + 1 ?>" action="../../../process/CRUDProcess.php" method="post" style="display:inline;">
                            <input type="hidden" name="nim" value="<?= htmlspecialchars($mahasiswa['NIM']) ?>" />
                            <input type="hidden" name="action" value="delete" />
                            <button type="button" class="btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $index + 1 ?>">
                              <i class="fa fa-trash text-white"></i>
                            </button>
                          </form>
                        </td>
                      </tr>

                      <!-- Modal Konfirmasi Hapus -->
                      <div class="modal fade" id="deleteModal<?= $index + 1 ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Apakah Anda yakin ingin menghapus data mahasiswa ini? Data yang dihapus tidak dapat dikembalikan.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <!-- Hapus tombol dan tambahkan 'data-bs-dismiss' untuk modal dan 'data-bs-target' untuk form submit -->
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="document.getElementById('deleteForm<?= $index + 1 ?>').submit();">Hapus</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Edit -->
                      <div class="modal fade" id="editModal<?= $index + 1 ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="../../../process/CRUDProcess.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update" />
                                <input type="hidden" name="nim" value="<?= htmlspecialchars($mahasiswa['NIM']) ?>" />
                                <input type="hidden" name="existing_foto" value="<?= htmlspecialchars($mahasiswa['fotoProfil']) ?>" />

                                <div class="mb-3">
                                  <label for="nim" class="form-label">NIM</label>
                                  <input type="text" class="form-control" id="nim" name="nim" value="<?= htmlspecialchars($mahasiswa['NIM']) ?>" readonly />
                                </div>
                                <div class="mb-3">
                                  <label for="nama" class="form-label">Nama Lengkap</label>
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required />
                                </div>
                                <div class="mb-3">
                                  <label for="jurusan" class="form-label">Jurusan</label>
                                  <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= htmlspecialchars($mahasiswa['jurusan']) ?>" required />
                                </div>
                                <div class="mb-3">
                                  <label for="prodi" class="form-label">Program Studi</label>
                                  <input type="text" class="form-control" id="prodi" name="prodi" value="<?= htmlspecialchars($mahasiswa['prodi']) ?>" required />
                                </div>
                                <div class="mb-3">
                                  <label for="angkatan" class="form-label">Angkatan</label>
                                  <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= htmlspecialchars($mahasiswa['angkatan']) ?>" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Tambah -->
                      <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addModalLabel">Tambah Data Mahasiswa</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <h5 class="mb-3">Data Mahasiswa</h5>
                                  <form action="../../../process/CRUDProcess.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="create" />

                                    <div class="mb-3">
                                      <label for="nama" class="form-label">Nama Lengkap</label>
                                      <input type="text" class="form-control" id="nama" name="nama" required />
                                    </div>
                                    <div class="mb-3">
                                      <label for="nim" class="form-label">NIM</label>
                                      <input type="text" class="form-control" id="nim" name="NIM" required />
                                    </div>
                                    <div class="mb-3">
                                      <label for="jurusan" class="form-label">Jurusan</label>
                                      <input type="text" class="form-control" id="jurusan" name="jurusan" required />
                                    </div>
                                    <div class="mb-3">
                                      <label for="prodi" class="form-label">Program Studi</label>
                                      <input type="text" class="form-control" id="prodi" name="prodi" required />
                                    </div>
                                    <div class="mb-3">
                                      <label for="angkatan" class="form-label">Angkatan</label>
                                      <input type="text" class="form-control" id="angkatan" name="angkatan" required />
                                    </div>
                                    <div class="mb-3">
                                      <label for="password" class="form-label">Password</label>
                                      <input type="password" class="form-control" id="password" name="password" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
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

    function confirmDelete(form) {
      // Cegah pengiriman form secara default
      event.preventDefault();

      var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal' + form.elements['nim'].value));
      deleteModal.show();
    }
  </script>
</body>

</html>