<?php

class CourseModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    private function columnExists(string $column): bool
    {
        $column = preg_replace('/[^a-zA-Z0-9_]/', '', $column);
        $stmt = $this->db->query("SHOW COLUMNS FROM course LIKE '{$column}'");
        return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fungsi untuk mengambil semua data dari tabel course
     * yang akan ditampilkan di dropdown Modal Upload
     */
    public function getAllCourses(): array
    {
        try {
            $idColumn = $this->columnExists('course_id') ? 'course_id' : 'id';
            $sql = sprintf('SELECT %s AS id, nama_course FROM course ORDER BY nama_course', $idColumn);
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
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
            $idColumn = $this->columnExists('course_id') ? 'course_id' : 'id';
            $columns = ['nama_course', 'deskripsi', 'created_by'];
            $params = [
                'nama_course' => $name,
                'deskripsi' => $description,
                'created_by' => $createdBy,
            ];

            $isAutoIncrement = $this->columnExists($idColumn) && stripos($this->getColumnExtra($idColumn), 'auto_increment') !== false;
            if (!$isAutoIncrement) {
                $columns[] = $idColumn;
                $params[$idColumn] = $id;
            }

            $sql = sprintf(
                'INSERT INTO course (%s) VALUES (%s)',
                implode(', ', $columns),
                implode(', ', array_map(function ($column) {
                    return ':' . $column;
                }, $columns))
            );

            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    private function getColumnExtra(string $column): string
    {
        $column = preg_replace('/[^a-zA-Z0-9_]/', '', $column);
        $stmt = $this->db->query("SHOW COLUMNS FROM course LIKE '{$column}'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Extra'] ?? '';
    }

    /**
     * Generate unique ID untuk course
     */
    public function generateId(): string
    {
        return bin2hex(random_bytes(10));
    }
}
