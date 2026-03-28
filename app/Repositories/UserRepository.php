<?php

namespace App\Repositories;

use PDO;

class UserRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Obtener todos los usuarios
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    // Verificar si email existe
    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM users WHERE email = :email"
        );

        $stmt->execute([
            'email' => $email
        ]);

        return (bool) $stmt->fetchColumn();
    }

    // Crear usuario
    public function create(array $data): array
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (email, password)
            VALUES (:email, :password)
        ");

        $stmt->execute([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);

        return [
            'id' => $this->db->lastInsertId(),
            'email' => $data['email']
        ];
    }
}