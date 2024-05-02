<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-list-page">

<?php include 'menu.html';

require_once 'functions.php';

$message = $_GET['message'] ?? null;

$tasks = getTasks();

?>

<div class="container">

    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Tasks</div>

    <?php foreach ($tasks as $task) : ?>
        <div class="list-container">
            <div class="info-text">
                <div>
                    <span data-task-id="<?php echo $task->id ?>"><?php print $task->description; ?></span>
                </div>
                <br>
                <div class="estimate">
                    <?php
                    $estimate = intval($task->estimate);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $estimate) {
                            echo '<div class="filled"></div>';
                        } else {
                            echo '<div class="empty"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="info-update">
                <div class="edit">
                    <a id="task-edit-link-<?php echo $task->id ?>"
                       href="task-form.php?id=<?php echo $task->id; ?>">Edit</a>
                </div>
                <div class="task-state">
                    <button class="state <?php echo $task->state; ?>"><span
                                id="task-state-<?php echo $task->id; ?>"><?php echo $task->state; ?></span></button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>