<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-list-page">

<?php include 'menu.html';

require_once 'controller.php';

$message = $_GET['message'] ?? null;

?>

<div class="container">

    <?php if ($message): ?>
        <div class="message-success" id="message-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Tasks</div>

    <?php foreach (getTasks() as $key => $taskRow) : ?>
        <?php $task = explode(',', $taskRow)?>
        <div class="list-container">
            <div class="info-text">
                <div>
                    <span data-task-id="<?php echo $task[0] ?>"><?php print $task[2]; ?></span>
                </div>
                <br>
                <div class="estimate">
                    <?php
                    $estimate = intval($task[3]);
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
                    <a id="task-edit-link-<?php echo $task[0] ?>"
                       href="task-form.php?id=<?php echo $task[0]; ?>">Edit</a>
                </div>
                <div class="task-state">
                    <button class="state <?php echo $task[4]; ?>"><span id="task-state-<?php echo $task[0]; ?>"><?php echo $task[4]; ?></span></button>
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