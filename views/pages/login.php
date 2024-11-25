<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- <header>
        <?php include('../layouts/header.php') ?>
    </header> -->
    <div class="container" style="width: 800px; height: 450px; padding: 20px;">
        <div class="row">
            <div class="col-md-6 d-flex flex-column" style="border-right: 1px solid black;">
                <h2>Sistem Informasi<br>Bebas Tanggungan</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sollicitudin turpis ligula, placerat accumsan mi luctus vitae. Morbi semper id metus et vulputate. Pellentesque molestie vehicula magna, in vehicula felis ultricies at. Nullam est nunc, pharetra nec sollicitudin non, aliquet a velit. Morbi consectetur, ex eget iaculis ultrices, orci felis sagittis magna, nec pretium tortor tortor at odio. Sed ex turpis, imperdiet eget condimentum eget, laoreet ut eros. Sed lacinia tristique ornare. Phasellus efficitur, eros nec consequat pellentesque, est nibh semper.</p>
            </div>
            <div class="col-md-6 d-flex flex-column" style="border-left: 1px solid black;">
                <img src="../../img/logo2.png" alt="SIMASBETA Logo" width="200">
                <h2>Hello, Welcome Back</h2>
                <p>Login to access your account</p>
                <div class="alert alert-danger" role="alert">
                    Masukkan username dan password<br>
                    (Menggunakan NIM sebagai username)
                </div>
                <div class="login-container">
                    <form action="../../controllers/loginController.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>