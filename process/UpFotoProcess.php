<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Nama file dan lokasi penyimpanan
        $fileName = basename($_FILES["file"]["name"]);
        $fileTmp = $_FILES["file"]["tmp_name"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Tipe file yang diperbolehkan
        $allowed_types = array("jpg", "jpeg");
        if (!in_array($fileType, $allowed_types)) {
            // Redirect with failure message for unsupported file types
            header("Location: ../views/pages/mahasiswa/account.php?message=upload_failed&error=invalid_file_type");
            exit();
        } else {
            // Direktori penyimpanan
            $uploadDir = "../upload/profile/";
            $filePath = $uploadDir . $fileName;

            // Ambil ID mahasiswa dari form
            $id_mhs = $_POST['id_mhs'];

            // Pindahkan file ke folder upload
            if (move_uploaded_file($fileTmp, $filePath)) {
                // Koneksi ke database
                include('../config/connection.php');

                // Query untuk menyimpan nama file dan memperbarui foto profil
                $sql = "UPDATE Mahasiswa 
                        SET fotoProfil = ?
                        WHERE id_mhs = ?";
                $stmt = sqlsrv_prepare($conn, $sql, array(&$fileName, &$id_mhs));

                // Eksekusi query
                if (sqlsrv_execute($stmt)) {
                    // Redirect dengan pesan sukses
                    header("Location: ../views/pages/mahasiswa/account.php?message=upload_success");
                    exit();
                } else {
                    // Query gagal, redirect dengan error
                    header("Location: ../views/pages/mahasiswa/account.php?message=upload_failed&error=query_error");
                    exit();
                }

                // Bebaskan statement dan tutup koneksi
                if ($stmt !== false) {
                    sqlsrv_free_stmt($stmt);
                }
                sqlsrv_close($conn);
            } else {
                // Error upload file
                header("Location: ../views/pages/mahasiswa/account.php?message=upload_failed&error=move_failed");
                exit();
            }
        }
    } else {
        // Jika tidak ada file yang diupload
        header("Location: ../views/pages/mahasiswa/account.php?message=upload_failed&error=no_file_uploaded");
        exit();
    }
}
