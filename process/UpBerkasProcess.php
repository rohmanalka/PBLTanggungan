<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Nama file dan lokasi penyimpanan
        $fileName = basename($_FILES["file"]["name"]);
        $fileTmp = $_FILES["file"]["tmp_name"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Tipe file yang diperbolehkan
        $allowed_types = array("jpg", "jpeg", "pdf");
        if (!in_array($fileType, $allowed_types)) {
            // Redirect with error message
            header("Location: ../views/pages/mahasiswa/uploadBerkas.php?message=upload_error");
            exit;
        } else {
            // Direktori penyimpanan
            $uploadDir = "../upload/berkasMhs/";
            $filePath = $uploadDir . $fileName;

            // Ambil ID tanggungan dari form
            $id_tanggungan = $_POST['id_tanggungan'];

            // Pindahkan file ke folder upload
            if (move_uploaded_file($fileTmp, $filePath)) {
                // Koneksi ke database
                include('../config/connection.php');

                // Query untuk menyimpan nama file dan memperbarui status
                $sql = "UPDATE tanggungan 
                        SET berkas = ?, status = 'pending' 
                        WHERE id_tanggungan = ?";
                $stmt = sqlsrv_prepare($conn, $sql, array(&$fileName, &$id_tanggungan));

                // Eksekusi query
                if (sqlsrv_execute($stmt)) {
                    // Redirect with success message
                    header("Location: ../views/pages/mahasiswa/uploadBerkas.php?message=upload_success");
                    exit;
                } else {
                    // Query execution failed
                    header("Location: ../views/pages/mahasiswa/uploadBerkas.php?message=upload_error");
                    exit;
                }

                // Bebaskan statement dan tutup koneksi
                if ($stmt !== false) {
                    sqlsrv_free_stmt($stmt);
                }
                sqlsrv_close($conn);
            } else {
                // File move failed
                header("Location: ../views/pages/mahasiswa/uploadBerkas.php?message=upload_error");
                exit;
            }
        }
    } else {
        // No file uploaded
        header("Location: ../views/pages/mahasiswa/uploadBerkas.php?message=upload_error");
        exit;
    }
}
?>
