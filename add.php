<?php
require 'config.php';

$title = $_POST["title"];
$content = $_POST["content"];

$stmt = $db->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
$stmt->execute([$title, $content]);

header("Location: index.php");
exit;
