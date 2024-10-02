<?php

use HotelEcho\Php\Utilities\Utilities;
use HotelEcho\Php\Models\Users;

require_once(__DIR__ . "../../validations/loging.validation.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = loginValidation($_POST);

    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/login.view.php");
    } else {
        try {
            $user = new Users();

            $theAccount = $user->findByEmail($email);

            if ($theAccount && $user->verifyPassword($password, $theAccount['password'])) {
                // Password is correct
                $_SESSION['user_id'] = $theAccount['id'];
                // Redirect to the home page or another appropriate page
                header("Location: /");
                exit();
            } else {
                // Invalid credentials
                $errors['login'] = 'Authentication failed. Please check your credentials and try again !';
                error_log("Invalid credentials for email: $email");
                require_once(__DIR__ . "../../views/login.view.php");
            }
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log("Database error: " . $e->getMessage());
            Utilities::abort(500);
        }
    }
} else {
    require_once(__DIR__ . "../../views/login.view.php");
}
