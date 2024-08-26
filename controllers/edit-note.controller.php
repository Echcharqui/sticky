<?php

require_once(__DIR__ . "../../validations/add-note.validation.php");

$pwd = "edit-note";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $noteContent = isset($_POST['note-content']) ? $_POST['note-content'] : '';
    $noteColor = isset($_POST['note-color']) ? $_POST['note-color'] : '';

    $errors = addNoteValidation($_POST);

    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/edit-note.view.php");
    } else {
        try {
            $database = new Database();

            $userId = $_SESSION['user_id']; // Replace with actual user_id

            $sql = "UPDATE Notes SET title = :title, content = :content, color = :color WHERE id = :id AND user_id = :user_id";
            $params = [
                ':id' => $id,
                ':user_id' => $userId,
                ':title' => $title,
                ':content' => $noteContent,
                ':color' => $noteColor
            ];

            $database->execute($sql, $params);

            // Set success message and redirect
            $_SESSION['success'] = 'Note updated successfully!';
            header("Location: /");
            die();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            abort(500);
        }
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    try {
        $database = new Database();

        $userId = $_SESSION['user_id']; // Replace with actual user_id

        $note = $database->fetch("SELECT * FROM Notes WHERE id = :id AND user_id = :user_id", [
            ':id' => $id,
            ':user_id' => $userId
        ]);

        if (!$note) {
            abort(404);
        }

        require_once(__DIR__ . "../../views/edit-note.view.php");
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        abort(500);
    }
}
