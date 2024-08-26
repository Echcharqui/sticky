<?php

require_once(__DIR__ . "../../validations/loging.validation.php");

$pwd = "login";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = loginValidation($_POST);

    if (!empty($errors)) {
        require_once(__DIR__ . "../../views/login.view.php");
    } else {
        try {
            $db = new Database();

            $sqlQuery = "select * from Users where email = :email;";
            $params = ['email' => $email];

            $theAccount = $db->fetch($sqlQuery, $params);

            if ($theAccount && password_verify($password, $theAccount['password'])) {
                // Password is correct
                session_start();
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
            abort(500);
        }
    }
} else {
    require_once(__DIR__ . "../../views/login.view.php");
}
