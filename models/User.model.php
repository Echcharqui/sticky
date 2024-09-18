<?php

require_once(__DIR__ . "../../database/Database.php");

class User
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection once in the constructor
        $this->db = new Database();
    }

    public function findById($id)
    {
        $sqlQuery = "SELECT * FROM Users WHERE id = :id;";
        $params = ['id' => $id];
        return $this->db->fetch($sqlQuery, $params);
    }

    public function findByEmail($email)
    {
        // Use $this->db to access the database instance
        $sqlQuery = "SELECT * FROM Users WHERE email = :email;";
        $params = ['email' => $email];
        return $this->db->fetch($sqlQuery, $params);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    public function insertNewUser($email, $username, $password)
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // SQL query to insert the note into the database
        $sql = "INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)";
        $params = [
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword
        ];

        // Insert the new user into the database
        return $this->db->execute($sql, $params);
    }

    public function updateAvatar($avatarFileName)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        // File upload successful, update the user's avatar in the database
        $sql = "UPDATE Users SET avatar = :avatar WHERE id = :id";
        $params = [
            ':avatar' => "/assets/uploads/avatars/" . $avatarFileName,
            ':id' => $userId
        ];

        return $this->db->execute($sql, $params);
    }

    public function checkIfEmailIsUsedByAnotherUser($email)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        $sqlQuery = "SELECT id FROM Users WHERE email = :email AND id != :id";
        $params = [
            'email' => $email,
            'id' => $userId
        ];

        return $this->db->fetch($sqlQuery, $params);
    }

    public function updateUserInfo($email, $username)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        // SQL query to update the user info in the database
        $sql = "UPDATE Users SET email = :email, username = :username WHERE id = :id";
        $params = [
            'email' => $email,
            'username' => $username,
            'id' => $userId
        ];

        // Execute the update

        return $this->db->execute($sql, $params);
    }

    public function changePassword($password)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // SQL query to update the password in the database
        $sql = "UPDATE Users SET password = :password WHERE id = :id";
        $params = [
            'password' => $hashedPassword,
            'id' => $userId
        ];

        // Update the user's password in the database
        return $this->db->execute($sql, $params);
    }
}
