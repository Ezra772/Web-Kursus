CREATE DATABASE db_course;
USE db_course;

-- =========================================
--  TABEL MAHASISWA
-- =========================================
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    jurusan VARCHAR(100),
    angkatan INT
) ENGINE=InnoDB;

-- =========================================
--  TABEL USERS (ADMIN & MAHASISWA)
--  role = 'admin' / 'mahasiswa'
--  mahasiswa_id mengarah ke tabel mahasiswa
-- =========================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'mahasiswa') NOT NULL,
    mahasiswa_id INT DEFAULT NULL,
    CONSTRAINT fk_users_mahasiswa
        FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================================
--  TABEL COURSE
-- =========================================
CREATE TABLE course (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_course VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    level VARCHAR(50),
    harga INT DEFAULT 0,
    gambar_url TEXT NULL
) ENGINE=InnoDB;

-- =========================================
--  TABEL PENDAFTARAN COURSE
-- =========================================
CREATE TABLE pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id INT NOT NULL,
    course_id INT NOT NULL,
    tanggal_daftar DATE NOT NULL,
    status ENUM('Menunggu Konfirmasi','Disetujui','Ditolak')
        DEFAULT 'Menunggu Konfirmasi',

    CONSTRAINT fk_pendaftaran_mahasiswa
        FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_pendaftaran_course
        FOREIGN KEY (course_id) REFERENCES course(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =========================================
--  DATA AWAL (OPSIONAL)
-- =========================================

-- Admin default (login: admin / 123456)
INSERT INTO users (username, password, role)
VALUES ('admin', '123456', 'admin');