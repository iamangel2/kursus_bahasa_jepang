CREATE DATABASE kursus_bahasa_jepang;

USE kursus_bahasa_jepang;

-- Tabel untuk menyimpan informasi kursus
CREATE TABLE kursus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    durasi VARCHAR(50)
);

-- Tabel untuk menyimpan materi yang terkait dengan kursus
CREATE TABLE materi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kursus_id INT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    link_embed TEXT,
    FOREIGN KEY (kursus_id) REFERENCES kursus(id) ON DELETE CASCADE
);
