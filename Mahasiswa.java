import java.util.Scanner;

public class Mahasiswa extends User {
    public String nama;
    public String nim;
    public String jenisKelamin;
    public String ttl;
    public String prodiJurusan;
    public String statusMahasiswa;
    public String noTelepon;
    public String email;

    public Mahasiswa(String id, String password, String nama, String nim, String jenisKelamin, 
                     String ttl, String prodiJurusan, String statusMahasiswa, 
                     String noTelepon, String email) {
        super(id, password);
        this.nama = nama;
        this.nim = nim;
        this.jenisKelamin = jenisKelamin;
        this.ttl = ttl;
        this.prodiJurusan = prodiJurusan;
        this.statusMahasiswa = statusMahasiswa;
        this.noTelepon = noTelepon;
        this.email = email;
    }

    public void inputBiodata() {
        Scanner sc = new Scanner(System.in);
        System.out.print("Masukkan Nama: ");
        this.nama = sc.nextLine();
        System.out.print("Masukkan NIM: ");
        this.nim = sc.nextLine();
        System.out.print("Masukkan Jenis Kelamin: ");
        this.jenisKelamin = sc.nextLine();
        System.out.print("Masukkan TTL: ");
        this.ttl = sc.nextLine();
        System.out.print("Masukkan Prodi dan Jurusan: ");
        this.prodiJurusan = sc.nextLine();
        System.out.print("Masukkan Status Mahasiswa: ");
        this.statusMahasiswa = sc.nextLine();
        System.out.print("Masukkan Nomor Telepon: ");
        this.noTelepon = sc.nextLine();
        System.out.print("Masukkan Email: ");
        this.email = sc.nextLine();
        System.out.println("Biodata berhasil diinput!");
    }

    public void cetakBiodata() {
        System.out.println("Biodata Mahasiswa:");
        System.out.println("Nama: " + nama);
        System.out.println("NIM: " + nim);
        System.out.println("Jenis Kelamin: " + jenisKelamin);
        System.out.println("TTL: " + ttl);
        System.out.println("Prodi dan Jurusan: " + prodiJurusan);
        System.out.println("Status Mahasiswa: " + statusMahasiswa);
        System.out.println("No Telepon: " + noTelepon);
        System.out.println("Email: " + email);
    }

    public void lihatTanggungan() {
        System.out.println("Tanggungan: UKT, Perpustakaan, dll.");
    }

    public void lakukanPembayaranUKT() {
        System.out.println("Pembayaran UKT berhasil dilakukan.");
    }

    public void uploadBuktiPembayaran() {
        System.out.println("Bukti pembayaran telah diupload.");
    }

    public void cetakSuratBebasTanggungan() {
        System.out.println("Surat Bebas Tanggungan telah dicetak.");
    }
}
