<?php

use HotelEcho\Php\Utilities\Utilities;
use HotelEcho\Php\Models\Users;

try {
    $user = new Users();

    $userId = $_SESSION['user_id']; // Replace with actual user_id

    $userInfo = $user->findById($userId);

    if (!$userInfo) {
        Utilities::abort(404);
    }

    require_once(__DIR__ . "../../views/settings.view.php");
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    Utilities::abort(500);
}
