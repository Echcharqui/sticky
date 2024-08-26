<?php

require_once(__DIR__ . "../../validations/edit-password.validation.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    session_start(); // Start session if not already started

    $userId = $_SESSION['user_id']; // Assuming user ID is stored in session
    $oldPassword = isset($_POST['old-password']) ? $_POST['old-password'] : '';
    $newPassword = isset($_POST['new-password']) ? $_POST['new-password'] : '';
    $newPasswordConfirmation = isset($_POST['new-password-confirmation']) ? $_POST['new-password-confirmation'] : '';

    $errors = editPasswordValidation($_POST);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors; // Store errors in session
        header("Location: /settings");
        die();
    } else {
        try {
            $db = new Database();

            // Fetch the current password hash from the database
            $user = $db->fetch("SELECT password FROM Users WHERE id = :id", ['id' => $userId]);

            if (!$user) {
                $_SESSION['errors'] = 'User not found !';
                header("Location: /settings");
                die();
            }

            // Verify the old password
            if (!password_verify($oldPassword, $user['password'])) {
                $_SESSION['errors'] = 'Old password is incorrect !';
                header("Location: /settings");
                die();
            }

            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // SQL query to update the password in the database
            $sql = "UPDATE Users SET password = :password WHERE id = :id";
            $params = [
                'password' => $hashedNewPassword,
                'id' => $userId
            ];

            // Update the user's password in the database
            $db->execute($sql, $params);

            // After successfully updating the password
            $_SESSION['success'] = 'Password updated successfully!';
            header("Location: /settings");
            die();
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log("Database error: " . $e->getMessage());
            abort(500);
        }
    }
} else {
    require_once(__DIR__ . "../../views/settings.view.php");
}
