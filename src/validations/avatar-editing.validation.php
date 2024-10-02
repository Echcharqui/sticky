<?php

function avatarValidation($params)
{
    $errors = [];

    // Ensure the avatar parameter is set
    $avatar = isset($params['avatar']) ? $params['avatar'] : '';

    // Validate file type
    if ($avatar["type"] !== "image/jpeg" && $avatar["type"] !== "image/png") {
        $errors['avatar'] = 'Unsupported image type. Only JPEG and PNG files are allowed.';
    }

    // Validate file size
    elseif ($avatar["size"] > 8000000) {
        $errors['avatar'] = 'The image size must not exceed 8MB.';
    }

    // Check for file upload errors
    elseif ($avatar["error"] !== UPLOAD_ERR_OK) {
        $errors['avatar'] = 'An error occurred during the file upload.';
    }

    return $errors;
}
