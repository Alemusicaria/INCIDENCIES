<?php

class PasswordReset
{
    private $conn;

    public function __construct()
    {
        require_once 'app/models/connexio.php';
        $this->conn = $conn;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM usuaris WHERE correu = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createToken($userId)
    {
        $token = bin2hex(random_bytes(50));
        $stmt = $this->conn->prepare("INSERT INTO password_resets (user_id, token) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();
        return $token;
    }

    public function getUserByToken($token)
    {
        $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE usuaris SET contrasenya = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();
    }

    public function deleteToken($token)
    {
        $stmt = $this->conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
    }
}
