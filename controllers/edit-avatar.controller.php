<?php

require_once(__DIR__ . "../../validations/avatar-editing.validation.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';

    $errors = avatarValidation($_FILES);

    $userId = $_SESSION["user_id"];

    if (!empty($errors)) {
        require_once(__DIR__ . '/../views/settings.view.php');
    } else {

        try {
            // Generate the timestamp once
            $currentTime = time();

            // Corrected path to the uploads directory
            $uploadDir = __DIR__ . '/../assets/uploads/avatars/';
            $avatarFileName = $currentTime . '_' . basename($avatar['name']);
            $uploadFile = $uploadDir . $avatarFileName;

            if (move_uploaded_file($avatar['tmp_name'], $uploadFile)) {

                $database = new Database();

                // File upload successful, update the user's avatar in the database
                $sql = "UPDATE Users SET avatar = :avatar WHERE id = :id";
                $params = [
                    ':avatar' => "/assets/uploads/avatars/" . $avatarFileName,
                    ':id' => $userId
                ];

                $database->execute($sql, $params);

                // After successfully updating the password
                $_SESSION['success'] = 'avatar updated successfully!';
                header("Location: /settings");
                die();
            } else {
                // If the file couldn't be moved, set an error and redirect
                $errors['avatar'] = 'Failed to upload the avatar image.';
                require_once(__DIR__ . '/../views/settings.view.php');
            }
        } catch (\Throwable $th) {
            // Log the error and display a user-friendly message
            error_log("error: " . $th->getMessage());
            abort(500);
        }
    }
} else {
    // If the request method is not POST, redirect to the settings page
    header("Location: /settings");
    die();
}
