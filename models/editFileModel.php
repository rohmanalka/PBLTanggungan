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
            echo "Sorry, only JPG, JPEG, and PDF files are allowed.";
        } else {
            // Direktori penyimpanan
            $uploadDir = "../upload/template";
            $filePath = $uploadDir . $fileName;

            // Ambil ID tanggungan dari form
            $id_jnsTanggungan = $_POST['id_jnsTanggungan'];

            // Koneksi ke database
            include('../config/connection.php');

            // Ambil nama file lama dari database untuk dihapus
            $sqlOldFile = "SELECT template FROM JenisTanggungan WHERE id_jnsTanggungan = ?";
            $stmtOldFile = sqlsrv_prepare($conn, $sqlOldFile, array(&$id_jnsTanggungan));

            if (sqlsrv_execute($stmtOldFile)) {
                $oldFile = sqlsrv_fetch_array($stmtOldFile, SQLSRV_FETCH_ASSOC)['berkas'];

                // Hapus file lama jika ada
                if ($oldFile && file_exists($uploadDir . $oldFile)) {
                    unlink($uploadDir . $oldFile);
                }
            }

            // Pindahkan file baru ke folder upload
            if (move_uploaded_file($fileTmp, $filePath)) {
                // Query untuk memperbarui nama file di database
                $sql = "UPDATE JenisTanggungan 
                        SET template = ? 
                        WHERE id_jnsTanggungan = ?";
                $stmt = sqlsrv_prepare($conn, $sql, array(&$fileName, &$id_jnsTanggungan));

                // Eksekusi query
                if (sqlsrv_execute($stmt)) {
                    echo "The file has been updated successfully";
                } else {
                    echo "Error: " . print_r(sqlsrv_errors(), true);
                }

                // Bebaskan statement dan tutup koneksi
                if ($stmt !== false) {
                    sqlsrv_free_stmt($stmt);
                }
                sqlsrv_close($conn);
            } else {
                echo "Failed to move the uploaded file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>