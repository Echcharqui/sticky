<?php

namespace HotelEcho\Php\Database;

use PDO;
use PDOException;
use HotelEcho\Php\Utilities\Utilities;

class Database
{
    private $host = '';
    private $db_name = '';
    private $username = '';
    private $password = '';
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            Utilities::abort(500);
        }
        return $this->conn;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $exception) {
            error_log("Query error: " . $exception->getMessage());
            Utilities::abort(500);
        }
    }

    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
