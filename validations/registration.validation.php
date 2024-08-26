<?php

function registrationValidation($params)
{
    $errors = [];

    $email = isset($params['email']) ? $params['email'] : '';
    $username = isset($params['username']) ? $params['username'] : '';
    $password = isset($params['password']) ? $params['password'] : '';
    $passwordConfirmation = isset($params['password-confirmation']) ? $params['password-confirmation'] : '';

    // Validate email
    if (strlen($email) === 0) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Validate username
    if (strlen($username) === 0) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 3) {
        $errors['username'] = 'Username must be at least 3 characters long';
    } elseif (strlen($username) > 20) {
        $errors['username'] = 'Username must not exceed 20 characters';
    }

    // Validate password
    if (strlen($password) === 0) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long';
    } elseif (strlen($password) > 32) {
        $errors['password'] = 'Password must not exceed 32';
    }

    // Validate password confirmation
    if (strlen($passwordConfirmation) === 0) {
        $errors['password-confirmation'] = 'Password confirmation is required';
    } elseif ($password !== $passwordConfirmation) {
        $errors['password-confirmation'] = 'Passwords do not match';
    }

    return $errors;
}
