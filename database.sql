CREATE TABLE Users (
    id_user INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(30) CHECK (role IN ('admin', 'mahasiswa')) 
)

CREATE TABLE Admin (
    id_admin INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    id_user INT NOT NULL,
    nip VARCHAR(30) NOT NULL,
    nama VARCHAR(50) NOT NULL
    CONSTRAINT FK_Admin_Users FOREIGN KEY (id_user)
    REFERENCES Users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE TABLE Mahasiswa (
    id_mhs INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    id_user INT NOT NULL,
    NIM VARCHAR(30) NOT NULL,
    nama VARCHAR(30) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    prodi VARCHAR(50) NOT NULL,
    angkatan VARCHAR(20) NOT NULL,
    fotoProfil VARCHAR(MAX) NULL
    CONSTRAINT FK_Mahasiswa_Users FOREIGN KEY (id_user)
    REFERENCES Users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE TABLE JenisTanggungan (
    id_jnsTanggungan INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    jenis_tanggungan VARCHAR(50) NOT NULL,
    keterangan VARCHAR(50) NOT NULL,
    template VARCHAR(255) NULL,
)

CREATE TABLE Tanggungan (
    id_tanggungan INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    id_jnsTanggungan INT NOT NULL,
    id_mhs INT NOT NULL,
    status VARCHAR(30) CHECK (status IN ('terpenuhi', 'pending', 'belum terpenuhi')) NOT NULL,
    berkas VARCHAR(255) NULL
    CONSTRAINT FK_Tanggungan_JenisTanggungan FOREIGN KEY (id_jnsTanggungan)
    REFERENCES JenisTanggungan (id_jnsTanggungan) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_Tanggungan_Mahasiswa FOREIGN KEY (id_mhs)
    REFERENCES Mahasiswa (id_mhs) ON DELETE CASCADE ON UPDATE CASCADE
)

INSERT INTO Users (username, [password], role)
VALUES 
('admin', '$2y$10$BJhNN0.Db3W670YqdqoPLOmB8KuzxTSJUoahagS2Z9eEaHmcy4meC', 'admin'),
('alka','$2y$10$gQ.umhud8QMHzhI6xPs8suFtTOveNQkMVFlZqsH7uEthKG9KtruX2', 'mahasiswa'),
('mei','$2y$10$uCp86f9/9ht3RK.WAe1erej6pX7aAVLZkp7Fs/bCs4e7Rb/eLI47a', 'mahasiswa'),
('lutfi','$2y$10$o2Y8RtEkhLrfgc3bPSBwPeCFF1tRNnjzn2TmSjdL9wU3GGDcO4Ckq', 'mahasiswa'),
('ivan','$2y$10$lL5iyilKuLHftJy/2Zv.jua2VbNrsa7sXt.eTHcoPBamPwv0xXbQm', 'mahasiswa'),
('zani','$2y$10$hTVOO8wjUrBzVbTkkJ40POnZ2cxaXboQC9md.abg2lYLUsR2zfUH6', 'mahasiswa');

INSERT INTO Admin (id_user, nip, nama)
VALUES
(1, '221144', 'ADMIN');

INSERT INTO Mahasiswa (id_user, NIM, nama, jurusan, prodi, angkatan)
VALUES
(2, '2341760055', 'MUHAMMAD ROHMAN AL KAUTSAR', 'TI', 'D-IV SIB', '2023'),
(3, '2341760031', 'MEISY NADIA NABABAN', 'TI', 'D-IV SIB', '2023'),
(4, '2341760181', 'LUTHFI PUTRA MAHARDIKA', 'TI', 'D-IV SIB', '2023'),
(5, '2341760128', 'IVAN RIZAL AHMADI', 'TI', 'D-IV SIB', '2023'),
(6, '2341760178', 'SARIA FAUZANI', 'TI', 'D-IV SIB', '2023');


INSERT INTO JenisTanggungan (jenis_tanggungan, keterangan)
VALUES
('Laporan Skripsi', 'File Laporan Skripsi'),
('Laporan Magang', 'File Laporan Magang'),
('Bebas Kompensasi', 'Surat Bebas Kompensasi'),
('TOEIC', 'Minimal Skor TOEIC 350'),
('Bebas Tanggungan Perpus', 'Surat Keterangan Bebas Tanggungan Perpus'),
('UKT', 'Lunas UKT'),
('Foto Ijazah', 'Background Merah'),
('SKKM', 'MInimal Point 15'),
('Berkas Pendamping', 'Sertifikasi Prestasi/Keahlian');

INSERT INTO Tanggungan (id_jnsTanggungan, id_mhs, [status])
SELECT
    jt.id_jnsTanggungan,
    m.id_mhs,
    'belum terpenuhi'
FROM
    JenisTanggungan jt
CROSS JOIN Mahasiswa m;