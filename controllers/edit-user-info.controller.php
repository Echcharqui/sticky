<?php
require_once(__DIR__ . "../../models/User.model.php");
require_once(__DIR__ . "../../validations/edit-user-info.validation.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    $errors = userInfoValidation($_POST);
    $userId = $_SESSION["user_id"];

    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/settings.view.php");
    } else {
        try {
            $user = new User();

            // Check if the email already exists for another user
            $existingUser =  $user->checkIfEmailIsUsedByAnotherUser($email);

            if ($existingUser) {
                $_SESSION['errors'] = 'Email already in use by another account!';
                header("Location: /settings");
                die();
            }

            // SQL query to update the user info in the database
            $user->updateUserInfo($email, $username);

            // Set success message and redirect
            $_SESSION['success'] = 'User info updated successfully!';
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
