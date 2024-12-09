<?php

class setAdminModel
{
    // CREATE (Tambah Data Mahasiswa)
    public static function createMahasiswa($conn, $data)
    {
        $sql = "INSERT INTO Mahasiswa (nama, NIM, jurusan, prodi, angkatan, fotoProfil) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = sqlsrv_prepare($conn, $sql, [
            $data['nama'],
            $data['NIM'],
            $data['jurusan'],
            $data['prodi'],
            $data['angkatan'],
            $data['fotoProfil']
        ]);

        if (sqlsrv_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // READ (Ambil Semua Data Mahasiswa)
    public static function getAllMahasiswa($conn)
    {
        $sql = "SELECT * FROM Mahasiswa";
        $stmt = sqlsrv_query($conn, $sql);

        if (!$stmt) {
            die("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public static function getUsers($conn)
    {
        $sql = "
            SELECT *
            FROM Users";
        $stmt = sqlsrv_query($conn, $sql);

        if (!$stmt) {
            die("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        $result = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    // UPDATE (Update Data Mahasiswa)
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

        if (sqlsrv_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    // DELETE (Hapus Data Mahasiswa dan User)
    public static function deleteMahasiswaAndUser($conn, $NIM)
    {
        // First, get the id_user associated with the mahasiswa
        $sql = "SELECT id_user FROM Mahasiswa WHERE NIM = ?";
        $stmt = sqlsrv_prepare($conn, $sql, [$NIM]);
        sqlsrv_execute($stmt);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($row) {
            $id_user = $row['id_user'];

            // Begin transaction
            sqlsrv_begin_transaction($conn);

            try {
                // Delete from Users table
                $sqlDeleteUser  = "DELETE FROM Users WHERE id_user = ?";
                $stmtDeleteUser  = sqlsrv_prepare($conn, $sqlDeleteUser, [$id_user]);
                sqlsrv_execute($stmtDeleteUser);

                // Delete from Mahasiswa table
                $sqlDeleteMahasiswa = "DELETE FROM Mahasiswa WHERE NIM = ?";
                $stmtDeleteMahasiswa = sqlsrv_prepare($conn, $sqlDeleteMahasiswa, [$NIM]);
                sqlsrv_execute($stmtDeleteMahasiswa);

                // Commit transaction
                sqlsrv_commit($conn);
                return true;
            } catch (Exception $e) {
                // Rollback transaction in case of error
                sqlsrv_rollback($conn);
                return false;
            }
        }
        return false;
    }
}

$model = new setAdminModel($conn);
$datamahasiswa = $model->getAllMahasiswa($conn);
$dataUser = $model->getUsers($conn);
