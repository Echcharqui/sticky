<?php

function userInfoValidation($params)
{
    $errors = [];

    $email = isset($params['email']) ? $params['email'] : '';
    $username = isset($params['username']) ? $params['username'] : '';

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

    return $errors;
}
