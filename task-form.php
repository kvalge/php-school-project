<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="task-form-page">

<?php

include 'menu.html';

require_once 'functions.php';

$id = $_GET['id'] ?? null;
$description = "";
$estimate = "";

if ($id) {
    foreach (getTasks() as $key => $task) {
        if ($task[0] == $id) {
            $description = $task[1];
            $estimate = $task[2];
        }
    }
}

?>

<div class="container">

    <?php if (isset($message)): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Task</div>
    <div class="form-container">

        <form method="POST" action="functions.php">
            <br>
            <div class="textarea">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"
                          cols="50"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : $description; ?></textarea>
            </div>
            <br>
            <div>
                <?php foreach (range(1, 5) as $est): ?>

                    <label>
                        <input type="radio"
                               name="estimate"
                            <?= strval($est) === (isset($_POST['estimate']) ? $_POST['estimate'] : $estimate) ? 'checked' : ''; ?>
                               value="<?= $est ?>"/>
                        <?= strval($est) ?>
                    </label>

                <?php endforeach; ?> </div>
            <br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="submitted" value="true">
            <button type="submit" name="submitButton" value="task">Save</button>
            <br>
        </form>

        <form method="POST" action="functions.php">
            <?php if ($id): ?>
                <input type="hidden" name="taskId" value="<?php echo $id; ?>">
                <button type="submit" name="deleteButton">Delete</button>
            <?php endif; ?>
        </form>

    </div>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>