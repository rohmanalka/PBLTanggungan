<?php
class AdminModel
{
    private $db;

    public function __construct($connection)
    {
        $this->db = $connection;
    }

    public function getAdminById($id_admin)
    {
        $sql = "
            SELECT
                id_admin,
                nip,
                nama
            FROM
                Admin
            WHERE
                id_admin = ?";
        $params = [$id_admin];
        $stmt = sqlsrv_query($this->db, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);

        return $data;
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

    public function countPendingTanggungan()
    {
        $sql = "SELECT COUNT(*) AS pending_count FROM Tanggungan WHERE status = 'pending'";
        $stmt = sqlsrv_query($this->db, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);

        return $row['pending_count'];
    }

    public function getPendingTanggungan($id_jnsTanggungan = [])
    {
        // Jika $id_jnsTanggungan kosong, jangan tambahkan filter tambahan
        if (empty($id_jnsTanggungan)) {
            $sql = "
                SELECT
                    mhs.nama,
                    mhs.NIM,
                    jt.jenis_tanggungan,
                    jt.keterangan,
                    t.id_tanggungan,
                    t.status,
                    t.berkas
                FROM
                    Mahasiswa mhs
                INNER JOIN
                    Tanggungan t ON mhs.id_mhs = t.id_mhs
                INNER JOIN
                    JenisTanggungan jt ON t.id_jnsTanggungan = jt.id_jnsTanggungan
                WHERE 
                    t.status = 'pending'";

            $stmt = sqlsrv_query($this->db, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            // Buat klausa IN dengan placeholder
            $placeholders = implode(',', array_fill(0, count($id_jnsTanggungan), '?'));
            $sql = "
                SELECT
                    mhs.nama,
                    mhs.NIM,
                    jt.jenis_tanggungan,
                    jt.keterangan,
                    t.id_tanggungan,
                    t.status,
                    t.berkas
                FROM
                    Mahasiswa mhs
                INNER JOIN
                    Tanggungan t ON mhs.id_mhs = t.id_mhs
                INNER JOIN
                    JenisTanggungan jt ON t.id_jnsTanggungan = jt.id_jnsTanggungan
                WHERE 
                    t.status = 'pending' AND t.id_jnsTanggungan IN ($placeholders)";

            $stmt = sqlsrv_prepare($this->db, $sql, $id_jnsTanggungan);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            if (!sqlsrv_execute($stmt)) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        // Ambil hasilnya
        $data = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }

        sqlsrv_free_stmt($stmt);
        return $data;
    }
}
// Buat instance dari kelas Database
$db = new connection();
$conn = $db->getConnection();

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../../../index.php");
    exit();
}

// Redirect admin if accessing student page
if ($_SESSION['role'] === 'mahasiswa') {
    header("Location: ../mahasiswa/dashboard.php");
    exit();
}
// Query to get student data based on id_user
$id_user = $_SESSION['id_user'];
$sqlAdmin = "SELECT id_admin FROM Admin WHERE id_user = ?";
$stmtAdmin = sqlsrv_query($conn, $sqlAdmin, [$id_user]);
$rowAdmin = sqlsrv_fetch_array($stmtAdmin, SQLSRV_FETCH_ASSOC);
$id_admin = $rowAdmin['id_admin'];

$model = new AdminModel($conn);
$tanggungan = $model->getDataJenisTanggungan();
$pendingCount = $model->countPendingTanggungan();
$pendingTanggungan = $model->getPendingTanggungan();
$dataAdmin = $model->getAdminById($id_admin);