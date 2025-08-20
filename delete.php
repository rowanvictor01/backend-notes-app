<?php

require "config.php";

if (!isset($_GET["id"])) {
    die("No note selected.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === null || $id === false) {
    die("Note id not valid.");
}

$stmt = $db->prepare("DELETE FROM notes where id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
