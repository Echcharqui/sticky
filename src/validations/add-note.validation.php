<?php

function addNoteValidation($params)
{
    $errors = [];

    $title = isset($params['title']) ? $params['title'] : '';
    $noteContent = isset($params['note-content']) ? $params['note-content'] : '';
    $noteColor = isset($params['note-color']) ? $params['note-color'] : '';

    // Predefined list of valid colors (as per the enum in the database)
    $validColors = [
        'yellow accent-4',
        'light-blue',
        'pink lighten-1',
        'blue-grey darken-1',
        'orange lighten-1'
    ];

    // Validate title
    if (strlen($title) === 0) {
        $errors['title'] = 'Title is required';
    } elseif (strlen($title) < 2) {
        $errors['title'] = 'Title must be at least 2 characters long';
    } elseif (strlen($title) > 20) {
        $errors['title'] = 'Title must not exceed 20 characters';
    }

    // Validate note content
    if (strlen($noteContent) === 0) {
        $errors['note-content'] = 'Note content is required';
    } elseif (strlen($noteContent) < 10) {
        $errors['note-content'] = 'Note content must be at least 10 characters long';
    } elseif (strlen($noteContent) > 400) {
        $errors['note-content'] = 'Note content must not exceed 400 characters';
    }

    // Validate note color
    if (strlen($noteColor) === 0) {
        $errors['note-color'] = 'Note color is required';
    } elseif (!in_array($noteColor, $validColors)) {
        $errors['note-color'] = 'Invalid note color selected';
    }

    return $errors;
}
