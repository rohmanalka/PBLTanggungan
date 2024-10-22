public class AdminJurusan extends Admin {
    public AdminJurusan(String id, String password, String nama) {
        super(id, password, nama);
    }

    public void tampilkanFitur() {
        System.out.println("Fitur Admin Jurusan:");
        System.out.println("1. Verifikasi Tanggungan Akademik (Kompen, SKKM, dll)");
    }
}
