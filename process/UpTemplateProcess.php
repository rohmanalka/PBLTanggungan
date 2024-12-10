<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $fileName = basename($_FILES["file"]["name"]);
        $fileTmp = $_FILES["file"]["tmp_name"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

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
            $uploadDir = "../../../upload/template/";
            $filePath = $uploadDir . $fileName;

            $id_jnsTanggungan = $_POST['id_jnsTanggungan'];

            if (move_uploaded_file($fileTmp, $filePath)) {
                require_once '../../../config/connection.php';
                // Membuat objek koneksi
                $db = new connection();

                // Mendapatkan koneksi aktif
                $conn = $db->getConnection();

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
                                text: 'Template berhasil diupload.',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = 'uploadTemplate.php'; // Redirect setelah OK
                            });
                        });
                    </script>";
                } else {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat mengupload template.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'uploadTemplate.php'; // Redirect setelah OK
                            });
                        });
                    </script>";
                }

                if ($stmt !== false) {
                    sqlsrv_free_stmt($stmt);
                }
                sqlsrv_close($conn);
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to move the uploaded file.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'uploadTemplate.php'; // Redirect setelah OK
                        });
                    });
                </script>";
            }
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'No file was uploaded.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'uploadTemplate.php'; // Redirect setelah OK
                });
            });
        </script>";
    }
}
