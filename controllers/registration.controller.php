<?php

require_once(__DIR__ . "../../validations/registration.validation.php");


$pwd = "registration";


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
            $db = new Database();

            // Check if the email already exists
            $existingUser = $db->fetch("SELECT * FROM Users WHERE email = :email", ['email' => $email]);

            if ($existingUser) {
                $errors['email'] = 'Email already exists';
                require_once(__DIR__ . "../../views/registration.view.php");
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // SQL query to insert the note into the database
                $sql = "INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)";
                $params = [
                    'email' => $email,
                    'username' => $username,
                    'password' => $hashedPassword
                ];


                // Insert the new user into the database
                $db->execute($sql, $params);

                // Redirect to the login page or another appropriate page
                registrationSuccessful();
            }
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log("Database error: " . $e->getMessage());
            abort(500);
        }
    }
} else {
    require_once(__DIR__ . "../../views/registration.view.php");
}
