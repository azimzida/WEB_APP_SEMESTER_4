<?php

class KategoriModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    public function getAllCategories(): array
    {
        $stmt = $this->db->query('SELECT kategori_id, nama_kategori, slug FROM kategori ORDER BY nama_kategori');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Membuat kategori baru
     */
    public function createCategory(string $id, string $name, string $slug): bool
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO kategori (id, nama_kategori, slug) VALUES (:id, :nama_kategori, :slug)');
            return $stmt->execute([
                'id' => $id,
                'nama_kategori' => $name,
                'slug' => $slug,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Generate unique ID untuk kategori
     */
    public function generateId(): string
    {
        return bin2hex(random_bytes(10));
    }

    /**
     * Generate slug dari nama kategori
     */
    public function generateSlug(string $name): string
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }
}
