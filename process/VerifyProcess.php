<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../config/connection.php');

    $id_tanggungan = $_POST['id_tanggungan'];
    $action = $_POST['action'];

    // Set the new status based on the action
    if ($action === 'approve') {
        $newStatus = 'terpenuhi';
    } elseif ($action === 'reject') {
        $newStatus = 'belum terpenuhi';
    } else {
        die("Aksi tidak valid.");
    }

    // Update status in the database
    $sql = "UPDATE Tanggungan SET status = ? WHERE id_tanggungan = ?";
    $stmt = sqlsrv_prepare($conn, $sql, array(&$newStatus, &$id_tanggungan));

    if (sqlsrv_execute($stmt)) {
        // Redirect after successful update
        // Redirect to the current page (berkasAkademik.php, berkasPerpus.php, or berkasJurusan.php)
        $redirectUrl = $_SERVER['HTTP_REFERER']; // Get the referring page URL
        header("Location: $redirectUrl");
        exit; // Ensure no further code is executed
    } else {
        // Handle error
        echo "Error: " . print_r(sqlsrv_errors(), true);
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    exit;
}
?>
