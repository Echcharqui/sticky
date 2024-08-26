<?php
// Set session cookie parameters
$lifetime = 60 * 60 * 24 * 5; // 5 days
session_set_cookie_params($lifetime, "/", "", false, true);

// Start the session
session_start();

require_once(__DIR__ . "/util/util.php");
require_once(__DIR__ . "/database/Database.php");
require_once(__DIR__ . "/router.php");
