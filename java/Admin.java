package java;
public class Admin extends User {
    public String nama;

    public Admin(String id, String password, String nama) {
        super(id, password);
        this.nama = nama;
    }

    public void tampilkanFitur() {
        System.out.println("Tampil Fitur");
    }
}
