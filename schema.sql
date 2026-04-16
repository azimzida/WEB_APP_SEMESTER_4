-- CREATE TABLES FOR EDU SHARE APPLICATION
-- Database: EDUSHARE_personroof (filess.io)

-- Tabel kategori
CREATE TABLE IF NOT EXISTS kategori (
    kategori_id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel course
CREATE TABLE IF NOT EXISTS course (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_course VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel materi
CREATE TABLE IF NOT EXISTS materi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    course_id INT NOT NULL,
    kategori_id INT NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    file_materi LONGBLOB,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT SAMPLE DATA

-- Insert kategori
INSERT INTO kategori (nama_kategori, slug) VALUES
('Programming', 'programming'),
('Database', 'database'),
('UI/UX Design', 'uiux-design'),
('Web Development', 'web-development');

-- Insert course
INSERT INTO course (nama_course, deskripsi, created_by) VALUES
('PHP Dasar', 'Belajar PHP untuk pemula hingga intermediate', 1),
('MySQL & Database', 'Memahami relational database dan SQL query', 1),
('Web Design dengan Tailwind', 'Membuat UI modern menggunakan Tailwind CSS', 1);