<?php

$pwd = "";

$colorsGroupe = ["light-blue", "pink lighten-1", "blue-grey darken-1"];

$db = new Database();

$select_sql = "select * from Notes WHERE user_id = :id";
$userId = $_SESSION["user_id"];
$notes = $db->fetchAll($select_sql, ['id' => $userId]);


require_once(__DIR__ . "../../views/home.view.php");
