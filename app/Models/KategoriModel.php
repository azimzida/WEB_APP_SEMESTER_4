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
}
