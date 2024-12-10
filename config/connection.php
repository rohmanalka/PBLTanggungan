<?php
class connection {
    private $serverName = "ALKAUTSAR";
    private $database = "DBSiBeTa";
    private $username = "sa";
    private $password = "BebasTanggungan";
    private $conn;

    // Constructor untuk membuka koneksi saat objek dibuat
    public function __construct() {
        $connectionInfo = [
            "Database" => $this->database,
            "Uid" => $this->username,
            "PWD" => $this->password
        ];

        // Membuka koneksi ke database
        $this->conn = sqlsrv_connect($this->serverName, $connectionInfo);

        if (!$this->conn) {
            die("Koneksi gagal: " . print_r(sqlsrv_errors(), true));
        }
    }

    // Getter untuk mendapatkan koneksi
    public function getConnection() {
        return $this->conn;
    }

    // Method untuk menutup koneksi
    public function closeConnection() {
        if ($this->conn) {
            sqlsrv_close($this->conn);
            $this->conn = null;
        }
    }

    // Destructor untuk memastikan koneksi ditutup saat objek dihapus
    public function __destruct() {
        $this->closeConnection();
    }
}
