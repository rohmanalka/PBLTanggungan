<?php
// Ensure the upload is POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Dapatkan isi file sebagai data biner
        $fileContent = file_get_contents($_FILES["file"]["tmp_name"]);
        $fileType = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        // Periksa tipe file yang diperbolehkan
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($fileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            include('../config/connection.php');

            // Dapatkan id_jenisTanggungan dari form
            $id_jenisTanggungan = $_POST['id_jenisTanggungan'];

            // Query untuk menyimpan data biner
            $sql = "UPDATE tanggungan SET berkas = CONVERT(VARBINARY(MAX), ?) WHERE id_jenisTanggungan = ?";
            $params = [$fileContent, $id_jenisTanggungan];
            $stmt = sqlsrv_query($conn, $sql, $params);

            if ($stmt) {
                echo "The file has been uploaded and the information has been stored in the database.";
            } else {
                echo "Error: " . print_r(sqlsrv_errors(), true);
            }

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
