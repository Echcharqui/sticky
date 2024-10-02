<?php
require_once __DIR__ . '/vendor/autoload.php';

// Set session cookie parameters
$lifetime = 60 * 60 * 24 * 5; // 5 days
session_set_cookie_params($lifetime, "/", "", false, true);

// Start the session
session_start();

// phpinfo();

require_once(__DIR__ . "/src/router.php");

