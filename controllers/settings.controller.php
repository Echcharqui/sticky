<?php

require_once(__DIR__ . "../../models/User.model.php");

try {
    $user = new User();

    $userId = $_SESSION['user_id']; // Replace with actual user_id

    $userInfo = $user->findById($userId);

    if (!$userInfo) {
        abort(404);
    }

    require_once(__DIR__ . "../../views/settings.view.php");
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    abort(500);
}
