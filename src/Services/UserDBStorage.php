<?php 
namespace App\Services;

use PDO;
use App\Configs\Config;

class UserDBStorage extends DBStorage implements ISaveStorage {
    public function saveData(string $name, array $data): bool {
        // ✅ Добавлено поле `token` в запрос
        $sql = "INSERT INTO `users` 
        (`username`, `email`, `password`, `token`, `is_verified`) 
        VALUES 
        (:name, :email, :pass, :token, :is_verified)";
        
        $sth = $this->connection->prepare($sql);
        return $sth->execute([
            'name' => $data['username'],
            'email' => $data['email'],
            'pass' => $data['password'],
            'token' => $data['token'],
            'is_verified' => 1 // По умолчанию пользователь не верифицирован
        ]);
    }

    public function uniqueEmail(string $email): bool {
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() === 0;
    }

    public function saveVerified($token): bool {
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE token = ? AND is_verified = 0");
        $stmt->execute([$token]);
        if ($user = $stmt->fetch()) {
            $update = $this->connection->prepare("UPDATE users SET is_verified = 1, token = '' WHERE id = ?");
            return $update->execute([$user['id']]);
        }
        return false;
    }

    public function loginUser($username, $password): bool {
        $stmt = $this->connection->prepare("SELECT id, username, password FROM users WHERE is_verified = 1 AND (username = ? OR email = ?)");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }
}