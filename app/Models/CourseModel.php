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

    /**
     * Membuat course baru
     */
    public function createCourse(string $id, string $name, string $description, string $createdBy): bool
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO course (id, nama_course, deskripsi, created_by) VALUES (:id, :nama_course, :deskripsi, :created_by)');
            return $stmt->execute([
                'id' => $id,
                'nama_course' => $name,
                'deskripsi' => $description,
                'created_by' => $createdBy,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Generate unique ID untuk course
     */
    public function generateId(): string
    {
        return bin2hex(random_bytes(10));
    }
}