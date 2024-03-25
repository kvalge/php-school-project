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

<nav>
    <a href="index.php"
       id="dashboard-link">Dashboard</a> |
    <a href="employee-list.php"
       id="employee-list-link">Employees</a> |
    <a href="employee-form.php"
       id="employee-form-link">Add Employee</a> |
    <a href="task-list.php"
       id="task-list-link">Tasks</a> |
    <a href="task-form.php"
       id="task-form-link">Add Task</a>
</nav>

<?php

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
                <div data-task-id="<?php $task[0] ?>"><?php echo $task[1]; ?></div><br>
                Estimate: <?php echo $task[2]; ?><br>
            </div>
            <div class="edit">
                <a id="task-edit-link-<?php $task[0] ?>" href="task-form.php?id=<?php echo $task[0]; ?>&description=<?php echo urlencode($task[1]); ?>">Edit</a>
            </div>
            <form method="post" action="functions.php">
                <input type="hidden" name="taskId" value="<?php echo $task[0]; ?>">
                <button type="submit" name="deleteButton" value="<?php echo $task[0]; ?>">Delete
                </button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    <hr>
    icd0007 Employee and Task Management Application
</div>

</body>

</html>