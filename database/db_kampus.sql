-- Tabel untuk Login (Akun)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'mahasiswa') NOT NULL
);

-- Tabel Data Mahasiswa
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    foto VARCHAR(255) DEFAULT 'default.jpg',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE mahasiswa ADD COLUMN semester INT DEFAULT 1;
-- DUMMY DATA (Password default: '123')
-- Kita masukkan password yang sudah di-hash (standar keamanan)
-- Hash '123' = $2y$10$tLgq.Xw/SgC.RzC0PZ.2Xu/XN8rQx.Xw/SgC.RzC0PZ.2Xu (Contoh simulasi)
-- Untuk memudahkan tahap awal belajar, kita gunakan password plain text dulu di database, 
-- nanti di PHP kita pakai password_verify kalau Anda sudah paham, 
-- TAPI agar sesuai standar Senior Dev, kita pakai MD5 dulu untuk simplifikasi UAS (atau password_hash di logic nanti).
-- Disini saya input manual password '123' (plain) dulu agar mudah dites, nanti logic login menyesuaikan.

INSERT INTO users (username, password, role) VALUES 
('admin', '123', 'admin'),
('mhs1', '123', 'mahasiswa');

-- Data Mahasiswa untuk mhs1 (user_id 2)
INSERT INTO mahasiswa (user_id, nim, nama, jurusan, email) VALUES 
(2, '10123001', 'Budi Santoso', 'Teknik Informatika', 'budi@kampus.id');