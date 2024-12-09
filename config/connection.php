<?php
$servername = "ALKAUTSAR";
$database = "DBSiBeTa";
$username = "sa";
$password = "BebasTanggungan";

// Koneksi ke database
$conn = sqlsrv_connect($servername, [
    "Database" => $database,
    "Uid" => $username,
    "PWD" => $password
]);

if (!$conn) {
    die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
}
?>