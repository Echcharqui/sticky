<?php

use HotelEcho\Php\Utilities\Utilities;
use HotelEcho\Php\Models\Notes;

$colorsGroupe = ["light-blue", "pink lighten-1", "blue-grey darken-1"];

try {
    $note = new Notes();
    $notes = $note->getAllNotes();
} catch (\Throwable $e) {
    error_log("Database error: " . $e->getMessage());
    Utilities::abort(500);
}

require_once(__DIR__ . "../../views/home.view.php");
