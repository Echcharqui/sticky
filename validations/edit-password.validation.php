<?php

function editPasswordValidation($params)
{
    $errors = [];

    $oldPassword = isset($params['old-password']) ? $params['old-password'] : '';
    $newPassword = isset($params['new-password']) ? $params['new-password'] : '';
    $newPasswordConfirmation = isset($params['new-password-confirmation']) ? $params['new-password-confirmation'] : '';

    // Validate old password
    if (strlen($oldPassword) === 0) {
        $errors['old-password'] = 'Old password is required';
    } elseif (strlen($oldPassword) < 6) {
        $errors['old-password'] = 'Old password must be at least 6 characters long';
    } elseif (strlen($oldPassword) > 32) {
        $errors['old-password'] = 'Old password must not exceed 32 characters';
    }

    // Validate new password
    if (strlen($newPassword) === 0) {
        $errors['new-password'] = 'New password is required';
    } elseif (strlen($newPassword) < 6) {
        $errors['new-password'] = 'New password must be at least 6 characters long';
    } elseif (strlen($newPassword) > 32) {
        $errors['new-password'] = 'New password must not exceed 32 characters';
    }

    // Validate new password confirmation
    if (strlen($newPasswordConfirmation) === 0) {
        $errors['new-password-confirmation'] = 'Password confirmation is required';
    } elseif ($newPassword !== $newPasswordConfirmation) {
        $errors['new-password-confirmation'] = 'Passwords do not match';
    }

    return $errors;
}
