<?php
class CekModel {
    private $db;

    /**
     * Konstruktor untuk inisialisasi koneksi database
     * 
     * @param resource $connection
     */
    public function __construct($connection) {
        $this->db = $connection;
    }

    /**
     * Mengambil tanggungan mahasiswa berdasarkan ID mahasiswa
     * 
     * @param mixed $id_mhs
     * @return array
     */
    public function getTanggunganByMahasiswa($id_mhs) {
        $sql = "
            SELECT 
                jt.jenis_tanggungan, 
                jt.keterangan, 
                t.status,
                t.id_tanggungan
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

    /**
     * Menghitung jumlah total, terpenuhi, dan belum terpenuhi tanggungan mahasiswa
     * 
     * @param mixed $id_mhs
     * @return array
     */
    public function countTanggunganStatus($id_mhs) {
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

    /**
     * Memeriksa apakah semua tanggungan mahasiswa sudah terpenuhi
     * 
     * @param mixed $id_mhs
     * @return bool
     */
    public function isAllTanggunganFulfilled($id_mhs) {
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
}
// Ambil ID mahasiswa dari session
$id_user = $_SESSION['id_user'];

// Query untuk mendapatkan id mahasiswa
$sqlMahasiswa = "SELECT id_mhs FROM Mahasiswa WHERE id_user = ?";
$stmtMahasiswa = sqlsrv_query($conn, $sqlMahasiswa, [$id_user]);
$rowMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC);
$id_mhs = $rowMahasiswa['id_mhs'];

// Inisialisasi model
$model = new CekModel($conn);
$tanggunganData = $model->getTanggunganByMahasiswa($id_mhs);
$tanggunganCount = $model->countTanggunganStatus($id_mhs);
$allFulfilled = $model->isAllTanggunganFulfilled($id_mhs);
?>