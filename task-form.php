<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-form-page">

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
$id = $_GET['id'] ?? null;
$description = isset($_GET['description']) ? urldecode($_GET['description']) : null;
$estimate = $_GET['estimate'] ?? null;

?>

<div class="container">
    <?php if ($message): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Task</div>
    <div class="form-container">
        <form method="POST" action="functions.php">
            <br>
            <div class="textarea">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"
                          cols="50"><?php if ($description): ?><?php echo $description; ?><?php endif; ?></textarea>
            </div>
            <br>
            <div>
                <?php foreach (range(1, 5) as $est): ?>

                    <label>
                        <input type="radio"
                               name="estimate"
                            <?= strval($est) === trim(strval($estimate)) ? 'checked' : ''; ?>
                               value="<?= $est ?>"/>
                        <?= strval($est) ?>
                    </label>

                <?php endforeach; ?> </div>
            <br>
            <?php if ($id): ?>
            <div>
                <input type="hidden" name="taskId" value="<?php echo $id; ?>">
                <button type="submit" name="deleteButton" value="<?php echo $id; ?>">Delete</button>
                <?php endif; ?>

                <button type="submit" name="submitButton" value="task">Save</button>
            </div>
            <br>
        </form>
    </div>
</div>

<div class="footer">
    <hr>
    icd0007 Employee and Task Management Application
</div>

</body>

</html>