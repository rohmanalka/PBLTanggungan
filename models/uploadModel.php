<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Dapatkan konten file sebagai data biner
        $fileContent = file_get_contents($_FILES["file"]["tmp_name"]);
        $fileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        // Periksa tipe file yang diperbolehkan
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($fileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Ambil ID tanggungan dari form
            $id_tanggungan = $_POST['id_tanggungan'];

            // Koneksi ke database
            include('../config/connection.php');

            // Query untuk menyimpan data biner ke kolom 'berkas'
            $sql = "UPDATE tanggungan SET berkas = CONVERT(varbinary(max), ?) WHERE id_tanggungan = ?";
            $stmt = sqlsrv_prepare($conn, $sql, array(&$fileContent, &$id_tanggungan));

            // Eksekusi query
            if (sqlsrv_execute($stmt)) {
                echo "The file has been uploaded and the information has been stored in the database.";
            } else {
                echo "Error: " . print_r(sqlsrv_errors(), true);
            }

            // Bebaskan statement dan tutup koneksi
            if ($stmt !== false) {
                sqlsrv_free_stmt($stmt);
            }
            sqlsrv_close($conn);
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
