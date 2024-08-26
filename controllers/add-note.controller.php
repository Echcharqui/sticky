<?php

require_once(__DIR__ . "../../validations/add-note.validation.php");

$pwd = "add-note";

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
            $database = new Database();

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
            $database->execute($sql, $params);


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
