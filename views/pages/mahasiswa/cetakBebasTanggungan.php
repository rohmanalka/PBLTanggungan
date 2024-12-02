<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <!-- css -->
  <?php include('css.php') ?>
  <!-- css -->
</head>

<body>
  <div class="wrapper">
    <div class="main-panel">
      <!-- sidebar -->
      <?php include('../../layouts/sidebar.php') ?>
      <!-- sidebar -->

      <!-- navbar -->
      <?php include('../../layouts/header.php') ?>
      <!-- navbar -->

      <!-- <main> -->
      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h2 class="fw-bold mb-3">Cetak Bebas Tanggungan</h2>
              <h6 class="op-7 mb-2">2341760055 / Muhammad Rohman Al Kautsar</h6>
            </div>
          </div>
          <div>
            <div class="card-header">
              <div class="card-head-row card-tools-still-right">
                <button class="button disabled">Request Bebas Tanggungan</button>  
                <p class="status"><strong>Status:</strong> <span style="color: red;">request</span></p>
              </div>
            </div>
            <div class="card-header">
              <div class="card-head-row card-tools-still-right">
                <button class="button disabled">Cetak Bebas Tanggungan</button>  
                <p> <span style="color: red;">*Tanggungan anda belum terpenuhi<br></span>
                Silahkan memenuhi tanggungan sebelum mencetak surat bebas tanggungan</p>
              </div>
            </div>
          </div>  
        </div>
      </div>
      <!-- <main> -->

      <!-- <footer> -->
      <?php include('../../layouts/footer.php') ?>
      <!-- <footer> -->
    </div>
  </div>
  <!-- js -->
  <?php include('js.php') ?>
  <!-- js -->
</body>

</html>