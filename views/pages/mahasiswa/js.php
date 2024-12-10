<script>
  document.querySelector('form').addEventListener('submit', function(event) {
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];

    if (file) {
      // Periksa tipe file
      var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
      if (!allowedTypes.includes(file.type)) {
        alert("Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.");
        event.preventDefault(); // Menghentikan form submission
        return;
      }

      // Periksa ukuran file
      var maxSize = 10 * 1024 * 1024; // 5MB
      if (file.size > maxSize) {
        alert("Sorry, the file is too large. Maximum allowed size is 5MB.");
        event.preventDefault();
        return;
      }
    }
  });
</script>

<!-- Onclick menu -->
<script>
  // Ambil semua elemen dengan kelas 'nav-item'
  const navItems = document.querySelectorAll('.nav-item');

  // Tambahkan event listener untuk setiap item
  navItems.forEach(item => {
    item.addEventListener('click', () => {
      // Hapus kelas 'active' dari semua item
      navItems.forEach(i => i.classList.remove('active'));

      // Tambahkan kelas 'active' pada item yang diklik
      item.classList.add('active');
    });
  });
</script>
<!--   Core JS Files   -->
<script src="../../../assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../../../assets/js/core/popper.min.js"></script>
<script src="../../../assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="../../../assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="../../../assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="../../../assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="../../../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../../../assets/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="../../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="../../../assets/js/kaiadmin.min.js"></script>