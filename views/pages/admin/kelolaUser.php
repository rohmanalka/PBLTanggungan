<?php
include '../../../config/connection.php';
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
                            <h6 class="op-7 mb-2">SimasBeta / Others / Settings / Kelola User</h6>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row card-tools-still-right">
                                    <div class="card-title">Kelola Users</div>
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
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataUser as $index => $user) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($user['username']) ?></td>
                                                <td>******</td> <!-- Menampilkan placeholder untuk password -->
                                                <td><?= htmlspecialchars($user['role']) ?></td>
                                                <td>
                                                    <!-- Tombol Edit dengan ikon -->
                                                    <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $index + 1 ?>">
                                                        <i class="fa fa-edit text-white"></i> <!-- Ikon edit -->
                                                    </button>

                                                    <!-- Form Hapus dengan ikon -->
                                                    <form method="post" style="display:inline;">
                                                        <input type="hidden" name="username" value="<?= htmlspecialchars($user['username']) ?>" />
                                                        <input type="hidden" name="action" value="delete" />
                                                        <button type="submit" class="btn-danger">
                                                            <i class="fa fa-trash text-white"></i> <!-- Ikon hapus -->
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal<?= $index + 1 ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="username" value="<?= htmlspecialchars($user['username']) ?>" />

                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Username</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                                                    <input type="password" class="form-control" id="password" name="password" />
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="role" class="form-label">Role</label>
                                                                    <select class="form-select" id="role" name="role" required>
                                                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                                        <option value="mahasiswa" <?= $user['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form>
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

            <!-- Modal Tambah -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../../../process/CRUDadmin.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="create" />
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required />
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" required />
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role" required>
                                        <option value="admin">Admin</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
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
                    window.location.href = "../../../controllers/logout.php";
                }
            });
        });

        $("#hapus").click(function(e) {
            swal({
                title: "Apakah anda yakin",
                text: "Anda tidak akan bisa mengembalikannya lagi!",
                type: "warning",
                buttons: {
                    confirm: {
                        text: "Yakin",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((Delete) => {
                if (Delete) {
                    swal("Data Mahasiswa berhasil di hapus!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                } else {
                    swal("Data Mahasiswa tidak dihapus!", {
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
            });
        });
    </script>
</body>

</html>