<?php
class MahasiswaModel
{
    private $db;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    public function getMahasiswaById($id_mhs)
    {
        $sql = "
            SELECT
                id_mhs,
                nama,
                NIM,
                jurusan,
                prodi,
                angkatan,
                fotoProfil
            FROM
                Mahasiswa
            WHERE
                id_mhs = ?";
        $params = [$id_mhs];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);

        return $data;
    }


    public function getTanggunganByMahasiswa($id_mhs)
    {
        $sql = "
            SELECT 
                jt.jenis_tanggungan, 
                jt.keterangan, 
                t.status,
                t.id_tanggungan,
                t.berkas
            FROM 
                Tanggungan t
            INNER JOIN 
                JenisTanggungan jt 
            ON 
                t.id_jnsTanggungan = jt.id_jnsTanggungan
            WHERE 
                t.id_mhs = ?";
        $params = [$id_mhs];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }

        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function countTanggunganStatus($id_mhs)
    {
        $sql = "
            SELECT 
                COUNT(*) AS total_tanggungan,
                SUM(CASE WHEN status = 'terpenuhi' THEN 1 ELSE 0 END) AS terpenuhi,
                SUM(CASE WHEN status = 'belum terpenuhi' THEN 1 ELSE 0 END) AS belum_terpenuhi
            FROM 
                Tanggungan
            WHERE 
                id_mhs = ?";
        $params = [$id_mhs];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        sqlsrv_free_stmt($stmt);
        return $row;
    }

    public function isAllTanggunganFulfilled($id_mhs)
    {
        $sql = "SELECT 
                    COUNT(*) AS belum_terpenuhi
                FROM 
                    Tanggungan
                WHERE 
                    id_mhs = ? AND status = 'belum terpenuhi'";
        $params = [$id_mhs];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);

        // Jika jumlah belum terpenuhi adalah 0, maka semua terpenuhi
        return $row['belum_terpenuhi'] === 0;
    }

    public function getDataJenisTanggungan()
    {
        // SQL query to fetch all data from the Tanggungan table
        $sql = "
            SELECT
                id_jnsTanggungan,
                jenis_tanggungan,
                keterangan,
                template
            FROM
                JenisTanggungan";

        // Execute the query
        $stmt = sqlsrv_query($this->db, $sql);

        // Check if the query was successful
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));  // If failed, output the error
        }

        // Fetch the data from the result set
        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;  // Append each row to the data array
        }

        sqlsrv_free_stmt($stmt);  // Free the statement to release resources
        return $data;  // Return the fetched data
    }
}

$db = new connection();
$conn = $db->getConnection();

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../../../index.php");
    exit();
}
if ($_SESSION['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit();
}

// Ambil ID mahasiswa dari session
$id_user = $_SESSION['id_user'];
// Query untuk mendapatkan id mahasiswa
$sqlMahasiswa = "SELECT id_mhs FROM Mahasiswa WHERE id_user = ?";
$stmtMahasiswa = sqlsrv_query($conn, $sqlMahasiswa, [$id_user]);
$rowMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);
$id_mhs = $rowMahasiswa['id_mhs'];

// Inisialisasi model
$model = new MahasiswaModel($conn);
$tanggunganData = $model->getTanggunganByMahasiswa($id_mhs);
$tanggunganCount = $model->countTanggunganStatus($id_mhs);
$allFulfilled = $model->isAllTanggunganFulfilled($id_mhs);
$dataMhs = $model->getMahasiswaById($id_mhs);
$nama = $dataMhs['nama'];
$panggilan = explode(" ", $nama)[1];
$foto = !empty($dataMhs['fotoProfil'])
    ? "../../../upload/profile/" . $dataMhs['fotoProfil']
    : "../../../upload/profile/default.jpg"; // Foto default jika kosong

// Tangkap parameter filter dari URL
$filterStatus = isset($_GET['filter']) ? $_GET['filter'] : '';
if ($filterStatus) {
    $tanggunganData = array_filter($tanggunganData, function ($data) use ($filterStatus) {
        return $data['status'] === $filterStatus;
    });
}
