<?php

class CourseModel extends Model
{
    private PDO $db;
    private array $tableColumnsCache = [];

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    private function getTableColumns(string $table): array
    {
        if (!isset($this->tableColumnsCache[$table])) {
            $stmt = $this->db->query('DESCRIBE ' . $table);
            $this->tableColumnsCache[$table] = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'Field');
        }

        return $this->tableColumnsCache[$table];
    }

    private function findColumn(string $table, array $candidates): ?string
    {
        $columns = $this->getTableColumns($table);

        foreach ($candidates as $column) {
            if (in_array($column, $columns, true)) {
                return $column;
            }
        }

        return null;
    }

    public function getAllCourses(): array
    {
        // Get categories from 'materi' table since 'course' table doesn't exist
        try {
            $stmt = $this->db->query("
                SELECT DISTINCT
                    kategori_id as id,
                    kategori_id,
                    'Category' as category,
                    'Category description' as description,
                    NULL as thumbnail
                FROM materi
                WHERE kategori_id IS NOT NULL
                ORDER BY kategori_id
            ");
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }

        $materialCounts = $this->getMaterialCounts();

        return array_map(function (array $course) use ($materialCounts) {
            $id = $course['id'] ?? null;

            return [
                'id' => $id,
                'title' => 'Category ' . ($id ?? 'Unknown'),
                'category' => trim((string) ($course['category'] ?? 'General')),
                'description' => trim((string) ($course['description'] ?? '')),
                'thumbnail' => $course['thumbnail'] ?? null,
                'materi_count' => $id ? ($materialCounts[(string) $id] ?? 0) : 0,
            ];
        }, $courses);
    }

    private function getMaterialCounts(): array
    {
        try {
            $stmt = $this->db->query('SELECT kategori_id, COUNT(*) AS total FROM materi WHERE kategori_id IS NOT NULL GROUP BY kategori_id');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }

        $counts = [];
        foreach ($rows as $row) {
            $counts[(string) ($row['kategori_id'] ?? '')] = isset($row['total']) ? (int) $row['total'] : 0;
        }

        return $counts;
    }
}
