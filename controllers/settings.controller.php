<?php


$pwd = "settings";

try {
    $database = new Database();

    $userId = $_SESSION['user_id']; // Replace with actual user_id

    $userInfo = $database->fetch("SELECT username, email, avatar FROM Users WHERE id = :id", [
        ':id' => $userId,
    ]);

    if (!$userInfo) {
        abort(404);
    }

    require_once(__DIR__ . "../../views/settings.view.php");
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    abort(500);
}
