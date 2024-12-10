<?php

class setAdminModel
{
    // CREATE (Tambah Data Mahasiswa)
    public function createMahasiswa($conn, $data)
    {
        // Check if id_user is present in the data
        if (!isset($data['id_user'])) {
            die("id_user is missing in the data");
        }

        // SQL query with placeholders for parameter binding
        $query = "EXEC AddMahasiswaWithTanggungan ?, ?, ?, ?, ?, ?, ?";

        // Prepare the query
        $stmt = sqlsrv_prepare($conn, $query, [
            $data['NIM'],
            $data['nama'],
            $data['jurusan'],
            $data['prodi'],
            $data['angkatan'],
            $data['fotoProfil'],
            $data['id_user']
        ]);

        // Check if the query was prepared successfully
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Execute the prepared statement
        $result = sqlsrv_execute($stmt);

        // Return the result of the execution
        return $result;
    }

    // CREATE (Tambah User)
    public function createUser($conn, $username, $passwordHash, $role)
    {
        // SQL query to insert the new user
        $query = "INSERT INTO Users (username, password, role) VALUES (?, ?, ?)";

        // Prepare the query
        $stmt = sqlsrv_prepare($conn, $query, [
            $username,
            $passwordHash,
            $role
        ]);

        if (sqlsrv_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($conn, $data)
    {
        // Check if password exists in $data, then construct query accordingly
        if (isset($data['password'])) {
            $query = "UPDATE Users SET password = ?, role = ? WHERE username = ?";
            $stmt = sqlsrv_prepare($conn, $query, [
                $data['password'],
                $data['role'],
                $data['username']
            ]);
        } else {
            $query = "UPDATE Users SET role = ? WHERE username = ?";
            $stmt = sqlsrv_prepare($conn, $query, [
                $data['role'],
                $data['username']
            ]);
        }

        // Execute the update query
        if (sqlsrv_execute($stmt)) {
            return true;
        }
        return false;
    }

    // Method to delete user
    public function deleteUser($conn, $username)
    {
        // SQL query to delete the user
        $query = "DELETE FROM Users WHERE username = ?";
        $stmt = sqlsrv_prepare($conn, $query, [$username]);

        if (sqlsrv_execute($stmt)) {
            return true;
        }
        return false;
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
            FROM Users
            WHERE role = 'mahasiswa'"; // Adding role filter for 'mahasiswa'
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

// Membuat objek koneksi
$db = new connection();
// Mendapatkan koneksi aktif
$conn = $db->getConnection();

$model = new setAdminModel($conn);
$datamahasiswa = $model->getAllMahasiswa($conn);
$dataUser = $model->getUsers($conn);
