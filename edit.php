<?php

require "config.php";

if (!isset($_GET["id"])) {
    die("No note selected.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === null || $id === false) {
    die("Not a valid id.");
}

$stmt = $db->prepare("SELECT * FROM notes WHERE id = ?");
$stmt->execute([$id]);
$note = $stmt->fetch();

if (!$note) {
    die("Note not found.");
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $new_title = $_POST["title"];
    $new_content = $_POST["content"];

    $stmt = $db->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$new_title, $new_content, $id]);

    header("Location: view.php?id={$id}");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing - <?= htmlspecialchars($note["title"]) ?></title>
</head>

<body>
    <article>
        <form method="post">
            <input type="text" name="title" value="<?= htmlspecialchars($note["title"]) ?>" autofocus required>
            <textarea name="content" rows="3" required><?= htmlspecialchars($note["content"]) ?></textarea>
            <button>Save</button>
            <button type="button" onclick="if(confirm('Discard Changes?')) window.location.href='view.php?id=<?= $id ?>'">Cancel</button>
        </form>
    </article>
</body>

</html>