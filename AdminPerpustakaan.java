class AdminPerpustakaan extends Admin {
    public AdminPerpustakaan(String id, String password, String nama) {
        super(id, password, nama);
    }

    public void tampilkanFitur() {
        System.out.println("Fitur Admin Perpustakaan:");
        System.out.println("1. Verifikasi Tanggungan Perpustakaan");
        System.out.println("2. Cetak Laporan Tanggungan Perpustakaan");
    }
}