<?php

class UserModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->query('SELECT id, nama, email, no_telp, foto_profil, role, created_at, updated_at FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById(string $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id, nama, email, no_telp, foto_profil, password, role, created_at, updated_at FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT id, nama, email, no_telp, foto_profil, password, role, created_at, updated_at FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function createUser(string $id, string $name, string $email, string $phone, string $password, string $role = 'user'): bool
    {
        $stmt = $this->db->prepare('INSERT INTO users (id, nama, email, no_telp, password, role) VALUES (:id, :nama, :email, :no_telp, :password, :role)');
        return $stmt->execute([
            'id' => $id,
            'nama' => $name,
            'email' => $email,
            'no_telp' => $phone,
            'password' => $password,
            'role' => $role,
        ]);
    }

    public function updateUser(string $id, array $data): bool
    {
        $allowed = ['nama', 'email', 'no_telp', 'password', 'role', 'foto_profil'];
        $fields = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowed, true)) {
                $fields[] = "$key = :$key";
                $params[$key] = $value;
            }
        }

        if (empty($fields)) {
            return false;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteUser(string $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function generateId(): string
    {
        return bin2hex(random_bytes(10));
    }
}
