<?php

namespace HotelEcho\Php\Models;

use HotelEcho\Php\Database\Database;

class Users
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection once in the constructor
        $this->db = new Database();
    }

    // Finds a user by their ID and returns an array or null
    public function findById(int $id): array|null
    {
        $sqlQuery = "SELECT * FROM Users WHERE id = :id;";
        $params = ['id' => $id];
        return $this->db->fetch($sqlQuery, $params);
    }

    // Finds a user by their email
    public function findByEmail(string $email): array|null
    {
        $sqlQuery = "SELECT * FROM Users WHERE email = :email;";
        $params = ['email' => $email];
        $result = $this->db->fetch($sqlQuery, $params);
    
        // If the result is false (no record found), return null instead of false
        return $result !== false ? $result : null;
    }
    
    // Verifies if the provided password matches the hashed password
    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    // Inserts a new user with the provided email, username, and password
    public function insertNewUser(string $email, string $username, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)";
        $params = [
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword
        ];

        return $this->db->execute($sql, $params);
    }

    // Updates the avatar of the user with the provided file name
    public function updateAvatar(string $avatarFileName): bool
    {
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE Users SET avatar = :avatar WHERE id = :id";
        $params = [
            ':avatar' => "/assets/uploads/avatars/" . $avatarFileName,
            ':id' => $userId
        ];

        return $this->db->execute($sql, $params);
    }

    // Checks if an email is already used by another user
    public function checkIfEmailIsUsedByAnotherUser(string $email): bool
    {
        $userId = $_SESSION['user_id'];

        // SQL query to check if email is already in use by another user
        $sqlQuery = "SELECT id FROM Users WHERE email = :email AND id != :id";
        $params = [
            'email' => $email,
            'id' => $userId
        ];

        // Fetch a single result
        $result = $this->db->fetch($sqlQuery, $params);

        // If a result is found, return true (email is used), otherwise return false
        return $result !== false;
    }

    // Updates the user's email and username
    public function updateUserInfo(string $email, string $username): bool
    {
        $userId = $_SESSION['user_id'];

        $sql = "UPDATE Users SET email = :email, username = :username WHERE id = :id";
        $params = [
            'email' => $email,
            'username' => $username,
            'id' => $userId
        ];

        return $this->db->execute($sql, $params);
    }

    // Changes the user's password
    public function changePassword(string $password): bool
    {
        $userId = $_SESSION['user_id'];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE Users SET password = :password WHERE id = :id";
        $params = [
            'password' => $hashedPassword,
            'id' => $userId
        ];

        return $this->db->execute($sql, $params);
    }
}
