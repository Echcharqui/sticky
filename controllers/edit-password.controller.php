<?php
require_once(__DIR__ . "../../models/User.model.php");
require_once(__DIR__ . "../../validations/edit-password.validation.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
            $user = new User();

            // Fetch the current user to extract the password and verifyed it
            $theUser = $user->findById($userId);

            if (!$theUser) {
                $_SESSION['errors'] = 'User not found !';
                header("Location: /settings");
                die();
            }

            // Verify the old password
            if (!$user->verifyPassword($oldPassword, $theUser['password'])) {
                $_SESSION['errors'] = 'Old password is incorrect !';
                header("Location: /settings");
                die();
            }

            // Update the user's password in the database
            $user->changePassword($newPassword);

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
