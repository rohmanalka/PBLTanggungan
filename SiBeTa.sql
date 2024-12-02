USE [SiBeTa]
GO

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
    jurusan VARCHAR(50) NOT NULL
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
    kelas VARCHAR(30) NOT NULL
    CONSTRAINT FK_Mahasiswa_Users FOREIGN KEY (id_user)
    REFERENCES Users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
)

CREATE TABLE JenisTanggungan (
    id_jnsTanggungan INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    jenis_tanggungan VARCHAR(50) NOT NULL,
    keterangan VARCHAR(50) NOT NULL,
    template VARBINARY(50) NULL,
)

CREATE TABLE Tanggungan (
    id_tanggungan INT IDENTITY(1,1) PRIMARY KEY NOT NULL,
    id_jnsTanggungan INT NOT NULL,
    id_mhs INT NOT NULL,
    status VARCHAR(30) CHECK (status IN ('terpenuhi', 'belum terpenuhi')) NOT NULL,
    berkas VARBINARY(MAX) NULL
    CONSTRAINT FK_Tanggungan_JenisTanggungan FOREIGN KEY (id_jnsTanggungan)
    REFERENCES JenisTanggungan (id_jnsTanggungan) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_Tanggungan_Mahasiswa FOREIGN KEY (id_mhs)
    REFERENCES Mahasiswa (id_mhs) ON DELETE CASCADE ON UPDATE CASCADE
)

INSERT INTO Users (username, [password], role)
VALUES 
('adminTI', '$2y$10$YRX4Mgd05SpPuQ3sSa03TO3was99wUAPoweK8ZhYMXaJFe8KHR.2K', 'admin'),
('2341760055','$2y$10$gQ.umhud8QMHzhI6xPs8suFtTOveNQkMVFlZqsH7uEthKG9KtruX2', 'mahasiswa'),
('2341760031','$2y$10$uCp86f9/9ht3RK.WAe1erej6pX7aAVLZkp7Fs/bCs4e7Rb/eLI47a', 'mahasiswa'),
('2341760181','$2y$10$o2Y8RtEkhLrfgc3bPSBwPeCFF1tRNnjzn2TmSjdL9wU3GGDcO4Ckq', 'mahasiswa');
INSERT INTO Users (username, [password], role)
VALUES 
('2341760128','$2y$10$lL5iyilKuLHftJy/2Zv.jua2VbNrsa7sXt.eTHcoPBamPwv0xXbQm', 'mahasiswa'),
('2341760178','$2y$10$H.KnyO6z8kjSg4IH7finhuHytq/eyd/Z6M8DIjz5AL5oi6lE4rloC', 'mahasiswa');

INSERT INTO Admin (id_user, nip, jurusan)
VALUES
(1, '2341711', 'TEKNOLOGI INFORMASI');

INSERT INTO Mahasiswa (id_user, NIM, nama, jurusan, prodi, kelas)
VALUES
(2, '2341760055', 'MUHAMMAD ROHMAN AL KAUTSAR', 'TEKNOLOGI INFORMASI', 'D-IV SIB', 'SIB 2C'),
(3, '2341760031', 'MEISY NADIA NABABAN', 'TEKNOLOGI INFORMASI', 'D-IV SIB', 'SIB 2C'),
(4, '2341760181', 'LUTHFI PUTRA MAHARDIKA', 'TEKNOLOGI INFORMASI', 'D-IV SIB', 'SIB 2C');
INSERT INTO Mahasiswa (id_user, NIM, nama, jurusan, prodi, kelas)
VALUES
(5, '2341760128', 'IVAN RIZAL AHMADI', 'TEKNOLOGI INFORMASI', 'D-IV SIB', 'SIB 2C'),
(6, '2341760178', 'SARIA FAUZANI', 'TEKNOLOGI INFORMASI', 'D-IV SIB', 'SIB 2C');


INSERT INTO JenisTanggungan (jenis_tanggungan, keterangan)
VALUES
('Bebas Kompensasi', 'Surat Kompensasi Presensi'),
('Laporan Magang', 'File Laporan Magang'),
('Laporan Skripsi', 'File Laporan Skripsi'),
('TOEIC', 'Sertifikat TOIEC Minimal Skor 350'),
('Tanggungan Perpustakaan', 'Surat Bebas Tanggungan Perpus');

INSERT INTO Tanggungan (id_jnsTanggungan, id_mhs, [status])
VALUES
(1, 1, 'belum terpenuhi'),
(2, 1, 'belum terpenuhi'),
(3, 1, 'belum terpenuhi'),
(1, 2, 'belum terpenuhi'),
(2, 2, 'belum terpenuhi'),
(3, 2, 'belum terpenuhi'),
(4, 2, 'belum terpenuhi'),
(1, 3, 'belum terpenuhi'),
(2, 3, 'belum terpenuhi'),
(3, 3, 'belum terpenuhi'),
(4, 3, 'belum terpenuhi'),
(5, 3, 'belum terpenuhi');
INSERT INTO Tanggungan (id_jnsTanggungan, id_mhs, [status])
VALUES
(1, 5, 'belum terpenuhi'),
(2, 5, 'belum terpenuhi'),
(3, 5, 'belum terpenuhi');