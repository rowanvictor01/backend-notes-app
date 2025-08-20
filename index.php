<?php
require "config.php";
$query_results = $db->query("SELECT id, title, created_at FROM notes ORDER BY created_at DESC");
$notes = $query_results->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
</head>

<body>
    <h1>Notes App</h1>

    <section>
        <h2>Add New Note</h2>
        <form action="add.php" method="post">
            <input type="text" name="title" placeholder="title" required>
            <br>
            <textarea name="content" placeholder="Start Typing..." rows="3"></textarea>
            <br>
            <button type="submit">Save Note</button>
        </form>
    </section>

    <section>
        <h2>My Notes</h2>
        <?php if (!count($notes)): ?>
            <p>No notes yet. Add one above.</p>
        <?php else: ?>
            <?php foreach ($notes as $note): ?>
                <div>
                    <a href="view.php?id=<?= $note["id"] ?>">
                        <h3><?= htmlspecialchars($note["title"]) ?></h3>
                    </a>
                    <p><?= htmlspecialchars($note["created_at"]) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</body>

</html>