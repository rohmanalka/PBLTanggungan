import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Main {
    public static List<Mahasiswa> daftarMahasiswa = new ArrayList<>();
    public static List<Admin> daftarAdmin = new ArrayList<>();

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);

        // Contoh menambah admin ke daftar
        daftarAdmin.add(new AdminKeuangan("adminKeuangan", "passadmin1", "Admin Keuangan"));
        daftarAdmin.add(new AdminJurusan("adminJurusan", "passadmin2", "Admin Jurusan"));
        daftarAdmin.add(new AdminPerpustakaan("adminPerpustakaan", "passadmin3", "Admin Perpustakaan"));

        while (true) {
            System.out.println("1. Mendaftar");
            System.out.println("2. Login");
            System.out.println("3. Keluar");
            System.out.print("Pilih opsi: ");
            int pilihan = sc.nextInt();
            sc.nextLine();  // Clear newline character

            if (pilihan == 1) {
                // Mendaftar
                System.out.print("Masukkan ID: ");
                String id = sc.nextLine();
                System.out.print("Masukkan Password: ");
                String password = sc.nextLine();
                System.out.print("Masukkan Nama: ");
                String nama = sc.nextLine();
                System.out.print("Masukkan NIM: ");
                String nim = sc.nextLine();
                System.out.print("Masukkan Jenis Kelamin: ");
                String jenisKelamin = sc.nextLine();
                System.out.print("Masukkan TTL: ");
                String ttl = sc.nextLine();
                System.out.print("Masukkan Prodi dan Jurusan: ");
                String prodiJurusan = sc.nextLine();
                System.out.print("Masukkan Status Mahasiswa: ");
                String statusMahasiswa = sc.nextLine();
                System.out.print("Masukkan Nomor Telepon: ");
                String noTelepon = sc.nextLine();
                System.out.print("Masukkan Email: ");
                String email = sc.nextLine();

                Mahasiswa mahasiswaBaru = new Mahasiswa(id, password, nama, nim, jenisKelamin, 
                                                         ttl, prodiJurusan, statusMahasiswa, 
                                                         noTelepon, email);
                daftarMahasiswa.add(mahasiswaBaru);
                System.out.println("Pendaftaran berhasil!");

            } else if (pilihan == 2) {
                // Login
                System.out.print("Masukkan ID: ");
                String id = sc.nextLine();
                System.out.print("Masukkan Password: ");
                String password = sc.nextLine();

                boolean found = false;

                // Cek login mahasiswa
                for (Mahasiswa mahasiswa : daftarMahasiswa) {
                    if (mahasiswa.login(id, password)) {
                        System.out.println("Login sebagai Mahasiswa berhasil!");
                        found = true;
                        while (true) {
                            System.out.println("\nMenu Fitur Mahasiswa:");
                            System.out.println("1. Input Biodata");
                            System.out.println("2. Cetak Biodata");
                            System.out.println("3. Lihat Tanggungan");
                            System.out.println("4. Lakukan Pembayaran UKT");
                            System.out.println("5. Upload Bukti Pembayaran");
                            System.out.println("6. Cetak Surat Bebas Tanggungan");
                            System.out.println("7. Logout");
                            System.out.print("Pilih fitur: ");
                            int fiturPilihan = sc.nextInt();
                            sc.nextLine();  // Clear newline character

                            switch (fiturPilihan) {
                                case 1:
                                    mahasiswa.inputBiodata();
                                    break;
                                case 2:
                                    mahasiswa.cetakBiodata();
                                    break;
                                case 3:
                                    mahasiswa.lihatTanggungan();
                                    break;
                                case 4:
                                    mahasiswa.lakukanPembayaranUKT();
                                    break;
                                case 5:
                                    mahasiswa.uploadBuktiPembayaran();
                                    break;
                                case 6:
                                    mahasiswa.cetakSuratBebasTanggungan();
                                    break;
                                case 7:
                                    System.out.println("Logout berhasil.");
                                    break;
                                default:
                                    System.out.println("Pilihan tidak valid.");
                            }

                            if (fiturPilihan == 7) {
                                break; // Keluar dari loop fitur mahasiswa
                            }
                        }
                        break;
                    }
                }

                // Cek login admin
                if (!found) {
                    for (Admin admin : daftarAdmin) {
                        if (admin.login(id, password)) {
                            System.out.println("Login sebagai Admin berhasil!");
                            found = true;
                            while (true) {
                                admin.tampilkanFitur();
                                System.out.print("Pilih fitur: ");
                                int fiturPilihan = sc.nextInt();
                                sc.nextLine();  // Clear newline character

                                // Dummy implementation for admin features
                                switch (fiturPilihan) {
                                    case 1:
                                        System.out.println("Cek Tanggungan UKT...");
                                        break;
                                    case 2:
                                        System.out.println("Verifikasi Pembayaran...");
                                        break;
                                    case 3:
                                        System.out.println("Cetak Laporan Pembayaran...");
                                        break;
                                    case 4:
                                        System.out.println("Verifikasi Tanggungan Akademik...");
                                        break;
                                    case 5:
                                        System.out.println("Verifikasi Tanggungan Perpustakaan...");
                                        break;
                                    case 6:
                                        System.out.println("Cetak Laporan Tanggungan Perpustakaan...");
                                        break;
                                    default:
                                        System.out.println("Pilihan tidak valid.");
                                }

                                System.out.print("Ingin kembali ke menu admin? (y/n): ");
                                char kembali = sc.nextLine().charAt(0);
                                if (kembali != 'y') {
                                    break; // Keluar dari loop fitur admin
                                }
                            }
                            break;
                        }
                    }
                }

                if (!found) {
                    System.out.println("Login gagal! ID atau password salah.");
                }

            } else if (pilihan == 3) {
                System.out.println("Keluar dari program.");
                break;
            } else {
                System.out.println("Pilihan tidak valid. Silakan coba lagi.");
            }
        }

        sc.close();
    }
}