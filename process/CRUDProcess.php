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
            'id_user' => $_POST['id_user'] // Include id_user here
        ];

        // Call the model's createMahasiswa function
        if ($model->createMahasiswa($conn, $data)) {
            header("Location: ../views/pages/admin/kelolaMahasiswa.php?message=success");
            exit();
        }
    }

    // Fungsi untuk tambah data user
    if (isset($_POST['action']) && $_POST['action'] === 'tambah') {
        $username = $_POST['username'];
        $password = $_POST['password']; // Password input
        $role = $_POST['role'];

        // Hash the password using PHP's password_hash function
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Call the model function to insert the user into the database
        $model = new setAdminModel($conn);

        // Call the method to add user and get the id_user
        $result = $model->createUser($conn, $username, $passwordHash, $role);
        if ($result) {
            header("Location: ../views/pages/admin/kelolaUser.php?message=success");
            exit();
        } else {
            header("Location: ../views/pages/admin/kelolaUser.php?message=error");
            exit();
        }
    }

    // Update User
    if (isset($_POST['action']) && $_POST['action'] === 'updateuser') {
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = $_POST['password'];
    
        // Jika password kosong, tidak perlu update password
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $updateData = ['username' => $username, 'password' => $passwordHash, 'role' => $role];
        } else {
            $updateData = ['username' => $username, 'role' => $role];
        }
    
        $model = new setAdminModel($conn);
        if ($model->updateUser($conn, $updateData)) {
            header("Location: ../views/pages/admin/kelolaUser.php?message=success");
            exit();
        } else {
            header("Location: ../views/pages/admin/kelolaUser.php?message=error");
            exit();
        }
    }
    
    //delete user
    if (isset($_POST['action']) && $_POST['action'] === 'deleteuser') {
        $username = $_POST['username'];
        $model = new setAdminModel($conn);
        if ($model->deleteUser($conn, $username)) {
            header("Location: ../views/pages/admin/kelolaUser.php?message=success");
            exit();
        } else {
            header("Location: ../views/pages/admin/kelolaUser.php?message=error");
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
