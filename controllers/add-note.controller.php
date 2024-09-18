<?php
require_once(__DIR__ . "../../models/Note.model.php");
require_once(__DIR__ . "../../validations/add-note.validation.php");


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Access form data and set default values if not set
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $noteContent = isset($_POST['note-content']) ? $_POST['note-content'] : '';
    $noteColor = isset($_POST['note-color']) ? $_POST['note-color'] : '';

    // Validate the form data
    $errors = addNoteValidation($_POST);

    // If there are validation errors, display the form with errors
    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/add-note.view.php");
    } else {    
        try {
            // Create a new database instance and establish a connection
            $note = new Note();

            $note->addNewNote($title, $noteContent, $noteColor);

            // Set success message and redirect
            $_SESSION['success'] = 'New note added successfully!';
            header("Location: /");
            die();
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log("Database error: " . $e->getMessage());
            abort(500);
        }
    }
} else {
    // If the request method is not POST, display the add-note form
    require_once(__DIR__ . "../../views/add-note.view.php");
}
