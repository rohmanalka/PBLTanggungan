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