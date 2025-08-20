<?php
require "config.php";

if (!isset($_GET["id"])) {
    die("No note selected.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === null || $id === false) {
    die("Invalid id.");
}

$stmt = $db->prepare("SELECT * FROM notes where id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch();

if (!$note) {
    die("Note not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($note["title"]) ?> - My Notes</title>
</head>

<body>
    <article>
        <h1><?= htmlspecialchars($note["title"]) ?></h1>
        <div>Created on: <?= htmlspecialchars($note["created_at"]) ?></div>
        <br>
        <div><?= nl2br(htmlspecialchars($note["content"])) ?></div>
        <br>
        <div>
            <a href="index.php">&leftarrow;Back To All Notes</a>
        </div>
    </article>
</body>

</html>