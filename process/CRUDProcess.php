<?php
require_once '../config/connection.php';
include '../models/setAdminModel.php';

// Membuat objek koneksi
$db = new connection();
// Mendapatkan koneksi aktif
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fungsi untuk tambah data mahasiswa
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        // Data Mahasiswa
        $data = [
            'nama' => $_POST['nama'],
            'NIM' => $_POST['NIM'],
            'jurusan' => $_POST['jurusan'],
            'prodi' => $_POST['prodi'],
            'angkatan' => $_POST['angkatan'],
            'fotoProfil' => null, // Default jika tidak ada foto
            'password' => $_POST['password'], // Hash the password
            'id_user' => $_POST['id_user'] // Include id_user here
        ];

        // Call the model's createMahasiswa function
        if ($model->createMahasiswa($conn, $data)) {
            header("Location: ../views/pages/admin/kelolaMahasiswa.php?message=success");
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
