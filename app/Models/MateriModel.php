<?php

class MateriModel extends Model
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

    private function getTableDefinition(string $table): array
    {
        $stmt = $this->db->query('DESCRIBE ' . $table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    private function isAutoIncrement(string $table, string $column): bool
    {
        $definition = $this->getTableDefinition($table);

        foreach ($definition as $row) {
            if ($row['Field'] === $column && strpos($row['Extra'] ?? '', 'auto_increment') !== false) {
                return true;
            }
        }

        return false;
    }

    private function isRequiredColumn(string $table, string $column): bool
    {
        $definition = $this->getTableDefinition($table);

        foreach ($definition as $row) {
            if ($row['Field'] !== $column) {
                continue;
            }

            if (strtolower($row['Null']) === 'no' && $row['Default'] === null && strpos($row['Extra'] ?? '', 'auto_increment') === false) {
                return true;
            }

            return false;
        }

        return false;
    }

    private function generateId(): string
    {
        try {
            return bin2hex(random_bytes(10));
        } catch (Throwable $e) {
            return uniqid('id_', true);
        }
    }

    public function createMaterial(array $data): bool
    {
        $table = 'materi';
        $columns = $this->getTableColumns($table);

        $fieldMap = [
            'judul' => ['judul', 'title', 'nama', 'name'],
            'deskripsi' => ['deskripsi', 'description', 'summary', 'content'],
            'file_materi' => ['file_materi', 'materi', 'file'],
            'user_id' => ['user_id', 'userId', 'created_by', 'uploaded_by'],
            'course_id' => ['course_id', 'courseId', 'id_course', 'course'],
            'kategori_id' => ['kategori_id', 'kategoriId', 'category'],
            'tanggal_upload' => ['tanggal_upload', 'created_at', 'uploaded_at'],
        ];

        $insertColumns = [];
        $insertParams = [];

        $timestampFields = ['created_at', 'tanggal_upload'];

        foreach ($fieldMap as $field => $names) {
            $column = $this->findColumn($table, $names);
            if (!$column) {
                continue;
            }

            if (in_array($field, $timestampFields, true) && !empty($column)) {
                $insertColumns[] = $column;
                $insertParams[':' . $column] = $data[$field] ?? date('Y-m-d H:i:s');
                continue;
            }

            if (array_key_exists($field, $data) && $data[$field] !== null && $data[$field] !== '') {
                $insertColumns[] = $column;
                $insertParams[':' . $column] = $data[$field];
            }
        }

        $idColumn = $this->findColumn($table, ['id', 'materi_id', 'uuid']);
        if ($idColumn && !isset($insertParams[':' . $idColumn]) && !$this->isAutoIncrement($table, $idColumn)) {
            $insertColumns[] = $idColumn;
            $insertParams[':' . $idColumn] = $this->generateId();
        }

        if (empty($insertColumns)) {
            return false;
        }

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', $insertColumns),
            implode(', ', array_map(fn($col) => ':' . $col, $insertColumns))
        );

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($insertParams);
    }
}
