<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'empty_fields':
            echo '<p style="color:red;">Harap isi username dan password!</p>';
            break;
        case 'query_failed':
            echo '<p style="color:red;">Terjadi kesalahan pada server. Coba lagi nanti.</p>';
            break;
        case 'wrong_password':
            echo '<p style="color:red;">Password yang Anda masukkan salah!</p>';
            break;
        case 'user_not_found':
            echo '<p style="color:red;">Username tidak ditemukan!</p>';
            break;
        default:
            echo '<p style="color:red;">Terjadi kesalahan. Silakan coba lagi.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css//index/style.css">
    <title>Login Page SimasBeTa</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="process/loginProcess.php" method="post">
                <img src="assets/img/brand.png">
                <p>Login to access your account</p>
                <div class="alert alert-danger" role="alert">
                    Masukkan username dan password<br>
                    (Menggunakan NIM sebagai username)
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="mt-3">
                    <a href="process/ForgotPassProcess.php" class="text-decoration-none">Lupa Password?</a>
                </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>About Us</h1>
                    <p>Sistem Informasi Bebas Tanggungan (SimasBeTa) adalah sistem yang dirancang untuk mengelola dan memverifikasi status tanggungan Mahasiswa di Polinema.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Welcome Back</h1>
                    <p>Ketahui lebih lanjut tentang SimasBeTa....</p>
                    <button class="hidden" id="register">About Us</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/css/index/script.js"></script>
</body>

</html>
