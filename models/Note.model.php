<?php

require_once(__DIR__ . "../../database/Database.php");

class Note
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection once in the constructor
        $this->db = new Database();
    }

    // get all notes func
    public function getAllNotes()
    {
        $select_sql = "select * from Notes WHERE user_id = :id";
        $userId = $_SESSION["user_id"];
        return $this->db->fetchAll($select_sql, ['id' => $userId]);
    }

    // get one note func
    public function getOneNote($id)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        return $this->db->fetch("SELECT * FROM Notes WHERE id = :id AND user_id = :user_id", [
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }

    // add a new note
    public function addNewNote($title, $noteContent, $noteColor)
    {
        // Assuming user_id is available from session or other means
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        // SQL query to insert the note into the database
        $sql = "INSERT INTO Notes (user_id, title, content, color) VALUES (:user_id, :title, :content, :color)";
        $params = [
            ':user_id' => $userId,
            ':title' => $title,
            ':content' => $noteContent,
            ':color' => $noteColor
        ];

        // Execute the SQL query with the parameters
        return $this->db->execute($sql, $params);
    }

    // update a note
    public function updateOneNote($noteId, $title, $noteContent, $noteColor)
    {
        $userId = $_SESSION['user_id']; // Replace with actual user_id

        $sql = "UPDATE Notes SET title = :title, content = :content, color = :color WHERE id = :id AND user_id = :user_id";
        $params = [
            ':id' => $noteId,
            ':user_id' => $userId,
            ':title' => $title,
            ':content' => $noteContent,
            ':color' => $noteColor
        ];

        return $this->db->execute($sql, $params);
    }

    // update a note
    public function deleteOneNote($noteId)
    {

        return $this->db->execute("DELETE FROM Notes WHERE id = :id", [
            ':id' => $noteId
        ]);
    }
}
