<?php

function loginValidation($params)
{
    $errors = [];

    $email = isset($params['email']) ? $params['email'] : '';
    $password = isset($params['password']) ? $params['password'] : '';

    // Validate email
    if (strlen($email) === 0) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Validate password
    if (strlen($password) === 0) {
        $errors['password'] = 'Password is required';
    } else if (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }

    return $errors;
}
