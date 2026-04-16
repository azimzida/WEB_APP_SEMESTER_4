<?php

class CourseModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    /**
     * Fungsi untuk mengambil semua data dari tabel course
     * yang akan ditampilkan di dropdown Modal Upload
     */
    public function getAllCourses(): array
    {
        try {
            // Kita ambil data langsung dari tabel course yang sudah kamu isi tadi
            $stmt = $this->db->query("SELECT id, nama_course, kategori_id, deskripsi FROM course ORDER BY nama_course");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Jika error, kembalikan array kosong agar web tidak crash
            return [];
        }
    }

    /**
     * Fungsi cadangan jika Controller memanggil findAll()
     */
    public function findAll(): array
    {
        return $this->getAllCourses();
    }
}