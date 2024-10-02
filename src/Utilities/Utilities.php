<?php

namespace HotelEcho\Php\Utilities;

class Utilities
{
    // A simple debugging function that outputs a value and stops execution.
    public static function dd(mixed $param): void
    {
        echo "<pre>";
        var_dump($param);
        echo "</pre>";
        die();
    }

    // A function that checks if the current URL path matches a given value.
    public static function urlIs(string $value): bool
    {
        return parse_url($_SERVER["REQUEST_URI"])["path"] === $value;
    }

    // Function to generate a standardized title for a web page.
    public static function generateHeadTitle(string $title): string
    {
        return strlen($title) > 0 ? "Sticky - " . $title : 'Sticky';
    }

    // Function to handle error pages and set the correct HTTP response code.
    public static function abort(int $errorCode = 404): void
    {
        http_response_code($errorCode);
        $errorViewPath = __DIR__ . '/../views/' . $errorCode . '.view.php';

        if (file_exists($errorViewPath)) {
            require_once($errorViewPath);
        } else {
            echo "Error {$errorCode}: The requested resource cannot be displayed.";
        }
        die();
    }

    // Function to handle successful registration, displaying a success view.
    public static function registrationSuccessful(): void
    {
        require_once(__DIR__ . '/../views/registration-successful.view.php');
        die();
    }

    // Function to check if a user is authenticated.
    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
