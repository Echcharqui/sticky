<?php

function dd($param)
{
    echo "<pre>";
    var_dump($param);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return  parse_url($_SERVER["REQUEST_URI"])["path"] === $value;
}

function generateHeadTitle($title)
{
    return strlen($title) > 0 ? "Sticky - " . $title : 'Sticky';
}

function abort($errorCode = 404): void
{
    http_response_code($errorCode);

    $errorViewPath = __DIR__ . '/../views/' . $errorCode . '.view.php';

    // Check if the error view file exists
    if (file_exists($errorViewPath)) {
        $pwd = $errorCode;
        require_once($errorViewPath);
    } else {
        // Handle the case where the error view does not exist
        echo "Error {$errorCode}: The requested resource cannot be displayed.";
    }
    die(); // Stop script execution after sending the error page
}

function registrationSuccessful()
{
    require_once(__DIR__ . '/../views/registration-successful.view.php');
    die();
}

function isAuthenticated()
{
    return isset($_SESSION['user_id']);
}
