<?php

class setAdminModel
{
    // CREATE (Tambah Data Mahasiswa Menggunakan Stored Procedure)
    public function createMahasiswa($conn, $data)
    {
        // Hash password yang diinputkan oleh user
        $PasswordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        // SQL query untuk memanggil stored procedure
        $query = "EXEC AddMahasiswaWithTanggungan ?, ?, ?, ?, ?, ?, ?";

        // Prepare statement dengan parameter yang sesuai
        $stmt = sqlsrv_prepare($conn, $query, [
            $data['NIM'],
            $data['nama'],
            $data['jurusan'],
            $data['prodi'],
            $data['angkatan'],
            $data['fotoProfil'],
            $PasswordHash // Kirim password yang sudah di-hash
        ]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute statement
        return sqlsrv_execute($stmt);
    }

    // UPDATE (Perbarui Data Mahasiswa)
    public static function updateMahasiswa($conn, $data)
    {
        $sql = "UPDATE Mahasiswa SET nama = ?, jurusan = ?, prodi = ?, angkatan = ?, fotoProfil = ? WHERE NIM = ?";
        $stmt = sqlsrv_prepare($conn, $sql, [
            $data['nama'],
            $data['jurusan'],
            $data['prodi'],
            $data['angkatan'],
            $data['fotoProfil'],
            $data['NIM']
        ]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return sqlsrv_execute($stmt);
    }

    // DELETE (Hapus Data Mahasiswa dan User)
    public static function deleteMahasiswaAndUser($conn, $NIM)
    {
        // Query untuk mendapatkan id_user
        $sql = "SELECT id_user FROM Mahasiswa WHERE NIM = ?";
        $stmt = sqlsrv_prepare($conn, $sql, [$NIM]);

        if ($stmt === false || !sqlsrv_execute($stmt)) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (!$row) {
            return false; // Mahasiswa tidak ditemukan
        }

        $id_user = $row['id_user'];

        // Mulai transaksi
        sqlsrv_begin_transaction($conn);

        try {
            // Hapus data pengguna
            $sqlDeleteUser = "DELETE FROM Users WHERE id_user = ?";
            $stmtDeleteUser = sqlsrv_prepare($conn, $sqlDeleteUser, [$id_user]);
            sqlsrv_execute($stmtDeleteUser);

            // Hapus data mahasiswa
            $sqlDeleteMahasiswa = "DELETE FROM Mahasiswa WHERE NIM = ?";
            $stmtDeleteMahasiswa = sqlsrv_prepare($conn, $sqlDeleteMahasiswa, [$NIM]);
            sqlsrv_execute($stmtDeleteMahasiswa);

            // Commit transaksi
            sqlsrv_commit($conn);
            return true;
        } catch (Exception $e) {
            // Rollback jika ada error
            sqlsrv_rollback($conn);
            return false;
        }
    }

    // READ (Ambil Semua Data Mahasiswa)
    public static function getAllMahasiswa($conn)
    {
        $sql = "SELECT * FROM Mahasiswa";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }

    // READ (Ambil Semua Data Pengguna dengan Role 'Mahasiswa')
    public static function getUsers($conn)
    {
        $sql = "SELECT * FROM Users WHERE role = 'mahasiswa'";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }
}

// Membuat objek koneksi
$db = new connection();
$conn = $db->getConnection();

$model = new setAdminModel($conn);
$datamahasiswa = $model->getAllMahasiswa($conn);
$dataUser = $model->getUsers($conn);
