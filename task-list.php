<?php

require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-list-page">

<?php include 'menu.html';

$message = $_GET['message'] ?? null;

?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Tasks</div>
    <?php foreach (getTasks() as $key => $task) : ?>
        <div class="list-container">
            <div>
                <div data-task-id="<?php $task[0] ?>">
                    <?php if ($task[0]) {
                        echo $task[1];
                    } ?>
                </div>
                <br>
                Estimate: <?php echo $task[2]; ?><br>
            </div>
            <div class="edit">
                <a id="task-edit-link-<?php $task[0] ?>"
                   href="task-form.php?id=<?php echo $task[0]; ?>">Edit</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>