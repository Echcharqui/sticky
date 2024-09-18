<?php

require_once(__DIR__ . "../../models/Note.model.php");

$colorsGroupe = ["light-blue", "pink lighten-1", "blue-grey darken-1"];

try {
    $note = new Note();
    $notes = $note->getAllNotes();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    abort(500);
}

require_once(__DIR__ . "../../views/home.view.php");
