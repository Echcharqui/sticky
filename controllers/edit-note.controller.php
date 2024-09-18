<?php
require_once(__DIR__ . "../../models/Note.model.php");
require_once(__DIR__ . "../../validations/add-note.validation.php");


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
            $note = new Note();

            $note->updateOneNote($id, $title, $noteContent, $noteColor);

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

        $note = new Note();

        $statement = $note->getOneNote($id);

        if (!$statement) {
            abort(404);
        }

        require_once(__DIR__ . "../../views/edit-note.view.php");
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        abort(500);
    }
}
