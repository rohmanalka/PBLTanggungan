<?php
include '../config/connection.php';
include '../models/setAdminModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fungsi untuk tambah data mahasiswa
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $data = [
            'nama' => $_POST['nama'],
            'NIM' => $_POST['NIM'],
            'jurusan' => $_POST['jurusan'],
            'prodi' => $_POST['prodi'],
            'angkatan' => $_POST['angkatan'],
            'fotoProfil' => null // Default jika tidak ada foto
        ];

        // Proses upload foto profil jika ada
        if (!empty($_FILES['foto_profil']['name'])) {
            $targetDir = "../upload/profile/";
            $fileName = basename($_FILES['foto_profil']['name']);
            $targetFilePath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $targetFilePath)) {
                $data['fotoProfil'] = $targetFilePath;
            }
        }

        // Panggil fungsi create dari model
        if ($model->createMahasiswa($conn, $data)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data mahasiswa berhasil ditambahkan.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '../views/pages/admin/kelolaMahasiswa.php'; // Redirect setelah OK
                    });
                });
            </script>";
            exit();
        }
    }

    // Fungsi untuk update data mahasiswa
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $data = [
            'nama' => $_POST['nama'],
            'NIM' => $_POST['nim'],
            'jurusan' => $_POST['jurusan'],
            'prodi' => $_POST['prodi'],
            'angkatan' => $_POST['angkatan'],
            'fotoProfil' => $_POST['existing_foto']
        ];

        // Proses upload foto profil jika ada
        if (!empty($_FILES['foto_profil']['name'])) {
            $targetDir = "../upload/profile/";
            $fileName = basename($_FILES['foto_profil']['name']);
            $targetFilePath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $targetFilePath)) {
                $data['fotoProfil'] = $targetFilePath;
            }
        }

        // Panggil fungsi update dari model
        if ($model->updateMahasiswa($conn, $data)) {
            // Setelah berhasil update, arahkan kembali ke halaman kelola mahasiswa
            header("Location: ../views/pages/admin/kelolaMahasiswa.php?message=success");
            exit();
        }
    }


    // Fungsi untuk delete data mahasiswa
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $NIM = $_POST['nim'];
        // Panggil fungsi hapus dari model
        if ($model->deleteMahasiswaAndUser($conn, $NIM)) {
            // Redirect dengan pesan sukses
            header("Location: ../views/pages/admin/kelolaMahasiswa.php?message=success");
            exit();
        } else {
            // Redirect dengan pesan error
            header("Location: ../views/pages/admin/kelolaMahasiswa.php?message=error");
            exit();
        }
    }
}
