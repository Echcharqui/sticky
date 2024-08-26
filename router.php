<?php

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [
    "/" => "/controllers/home.controller.php",
    "/login" => "/controllers/login.controller.php",
    "/registration" => "/controllers/registration.controller.php",
    "/logout" => "/controllers/logout.controller.php",
    "/settings" => "/controllers/settings.controller.php",
    "/add-note" => "/controllers/add-note.controller.php",
    "/edit-note" => "/controllers/edit-note.controller.php",
    "/delete-note" => "/controllers/delete-note.controller.php",
    "/edit-avatar" => "/controllers/edit-avatar.controller.php",
    "/edit-user-info" => "/controllers/edit-user-info.controller.php",
    "/edit-password" => "/controllers/edit-password.controller.php"
];


function enforceAccessControl($route, $isAuthenticated)
{
    $publicRoutes = ["/login", "/registration"];
    $protectedRoutes = ["/", "/settings", "/add-note", "/delete-note", "/edit-avatar", "/edit-user-info", "/edit-password", "/logout"];

    if (in_array($route, $protectedRoutes) && !$isAuthenticated) {
        // Redirect to login if trying to access a protected route while unauthenticated
        header("Location: /login");
        exit();
    } elseif (in_array($route, $publicRoutes) && $isAuthenticated) {
        // Redirect to home if trying to access a public route while authenticated
        header("Location: /");
        exit();
    }
}

if (array_key_exists($uri, $routes)) {
    enforceAccessControl($uri, isAuthenticated());
    require_once(__DIR__ . $routes[$uri]);
} else {
    abort(404);
}
