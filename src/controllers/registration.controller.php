<?php

use HotelEcho\Php\Models\Users;
use HotelEcho\Php\Utilities\Utilities;

require_once(__DIR__ . "../../validations/registration.validation.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordConfirmation = isset($_POST['password-confirmation']) ? $_POST['password-confirmation'] : '';

    $errors = registrationValidation($_POST);

    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/registration.view.php");
    } else {
        try {
            $user = new Users();

            // Check if the email already exists
            $existingUser = $user->findByEmail($email);

            if ($existingUser) {
                $errors['email'] = 'Email already exists';
                require_once(__DIR__ . "../../views/registration.view.php");
            } else {
                // insertion of a new user
                $user->insertNewUser($email, $username, $password);
                // Redirect to the login page or another appropriate page
                Utilities::registrationSuccessful();
            }
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log("Database error: " . $e->getMessage());
            Utilities::abort(500);
        }
    }
} else {
    require_once(__DIR__ . "../../views/registration.view.php");
}
