package java;
public class AdminKeuangan extends Admin {
    public AdminKeuangan(String id, String password, String nama) {
        super(id, password, nama);
    }

    public void tampilkanFitur() {
        System.out.println("Fitur Admin Keuangan:");
        System.out.println("1. Cek Tanggungan UKT");
        System.out.println("2. Verifikasi Pembayaran");
        System.out.println("3. Cetak Laporan Pembayaran");
    }
}
