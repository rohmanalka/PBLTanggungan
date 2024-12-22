<?php
require_once '../vendor/autoload.php';
require_once '../config/connection.php';
require_once '../models/MahasiswaModel.php';

use Dompdf\Dompdf;

// Membuat koneksi database
$db = new connection();
$conn = $db->getConnection();

if (!$rowMahasiswa) {
    die("Mahasiswa tidak ditemukan.");
}

if (!$dataMhs) {
    die("Data mahasiswa tidak ditemukan.");
}

if (!$allFulfilled) {
    die("Tanggungan mahasiswa belum terpenuhi. Tidak dapat menghasilkan surat.");
}

// Buat konten HTML untuk PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">SURAT BEBAS TANGGUNGAN</h2>
    <br>
    <p>Telah diterima tanggungan mahasiswa berikut:</p>
    <table>
        <tr>
            <td><strong>Nama Lengkap</strong></td>
            <td>:</td>
            <td>' . htmlspecialchars($dataMhs['nama']) . '</td>
        </tr>
        <tr>
            <td><strong>NIM</strong></td>
            <td>:</td>
            <td>' . htmlspecialchars($dataMhs['NIM']) . '</td>
        </tr>
        <tr>
            <td><strong>Program Studi</strong></td>
            <td>:</td>
            <td>' . htmlspecialchars($dataMhs['prodi']) . '</td>
        </tr>
        <tr>
            <td><strong>Jurusan</strong></td>
            <td>:</td>
            <td>' . htmlspecialchars($dataMhs['jurusan']) . '</td>
        </tr>
        <tr>
            <td><strong>Angkatan</strong></td>
            <td>:</td>
            <td>' . htmlspecialchars($dataMhs['angkatan']) . '</td>
        </tr>
    </table>
    <p style="margin-top: 20px;">
        Diberikan pada mahasiswa di atas bahwasanya telah dipenuhi semua tanggungan untuk syarat kelulusan dan pengambilan ijazah.
    </p>
    <br><br>
    <div class="ttd">
        <p>Mengetahui,</p>
        <p>Koordinator Program Studi ' . htmlspecialchars($dataMhs['prodi']) . '</p>
        <br><br>
        <p>________________________</p>
        <p>ADMIN</p>
        <p>22113344</p>
    </div>
</body>
</html>
';

// Debug HTML
// file_put_contents('debug.html', $html);

// Inisialisasi Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Bersihkan buffer
if (ob_get_length()) {
    ob_end_clean();
}

// Unduh file PDF
$filename = "Surat_Bebas_Tanggungan_" . $dataMhs['NIM'] . ".pdf";
$dompdf->stream($filename, ["Attachment" => 1]);
