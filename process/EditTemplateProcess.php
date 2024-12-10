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
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Only JPG, JPEG, and PDF files are allowed.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'uploadTemplate.php'; // Redirect after OK
                    });
                });
            </script>";
        } else {
            // Direktori penyimpanan
            $uploadDir = "../upload/template/";
            $filePath = $uploadDir . $fileName;

            // Ambil ID tanggungan dari form
            $id_jnsTanggungan = $_POST['id_jnsTanggungan'];

            // Koneksi ke database
            require_once('../config/connection.php');
            // Membuat objek koneksi
            $db = new connection();

            // Mendapatkan koneksi aktif
            $conn = $db->getConnection();

            // Ambil nama file lama dari database untuk dihapus
            $sqlOldFile = "SELECT template FROM JenisTanggungan WHERE id_jnsTanggungan = ?";
            $stmtOldFile = sqlsrv_prepare($conn, $sqlOldFile, array(&$id_jnsTanggungan));

            if (sqlsrv_execute($stmtOldFile)) {
                $oldFile = sqlsrv_fetch_array($stmtOldFile, SQLSRV_FETCH_ASSOC)['template'];

                // Hapus file lama jika ada
                if ($oldFile && file_exists($uploadDir . $oldFile)) {
                    unlink($uploadDir . $oldFile);
                }
            }

            // Pindahkan file baru ke folder upload
            if (move_uploaded_file($fileTmp, $filePath)) {
                // Update the file name in the database
                $sql = "UPDATE JenisTanggungan 
            SET template = ? 
            WHERE id_jnsTanggungan = ?";
                $stmt = sqlsrv_prepare($conn, $sql, array(&$fileName, &$id_jnsTanggungan));

                if (sqlsrv_execute($stmt)) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Template berhasil diedit.',
                                icon: 'success'
                            }).then(() => {
                                // Close the Edit File modal using Bootstrap modal API
                                $('#editModal" . $data['id_jnsTanggungan'] . "').modal('hide');
                                $('form')[0].reset();
                            });
                        });
                    </script>";
                } else {
                    echo "Error: " . print_r(sqlsrv_errors(), true);
                }

                // Free the prepared statement
                if ($stmt !== false) {
                    sqlsrv_free_stmt($stmt);
                }
            } else {
                echo "Failed to move the uploaded file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
