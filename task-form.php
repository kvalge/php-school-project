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
$employee = "";

if ($id) {
    foreach (getTasks() as $key => $task) {
        if ($task[0] === $id) {
            $description = $task[1];
            $estimate = $task[2];
            foreach (getEmployees() as $key => $emp) {
                if (intval($task[3]) === intval($emp[0])) {
                    $employee = $emp;
                }
            }
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
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4"
                          cols="31"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : $description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="estimate">Estimate:</label>
                <?php foreach (range(1, 5) as $est): ?>
                    <input type="radio"
                           name="estimate"
                        <?= strval($est) === ($_POST['estimate'] ?? $estimate) ? 'checked' : ''; ?>
                           value="<?= $est ?>"/>
                    <?= strval($est) ?>
                <?php endforeach; ?> </div>

            <div class="form-group">
                <label for="employeeId">Assigned to:</label>
                <select name="employeeId">
                    <option value="<?php echo $employee[0] ?? ""; ?>"
                            label="<?php echo isset($employee[0]) ? $employee[1] . " " . $employee[2] : ""; ?>"></option>
                    <?php foreach (getEmployees() as $key => $emp) : ?>
                        <?php if ($emp[0] !== $employee[0]): ?>
                            <option value="<?php echo $emp[0] ?>"><?php print $emp[1] . ' ' . $emp[2]; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>

            </div>

            <?php if ($id): ?>
                <div class="form-group">
                    <label for="completed">Completed:</label>
                    <input type="checkbox" id="completed" name="completed" value="completed">
                </div>
            <?php endif; ?>


            <div class="<?php echo ($id) ? 'two-button' : 'one-button'; ?>">
                <?php if ($id): ?>
                    <input type="hidden" name="taskId" value="<?php echo $id; ?>">
                    <button type="submit" name="deleteButton">Delete</button>
                <?php endif; ?>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="submitted" value="true">
                <button type="submit" name="submitButton" value="task">Save</button>
            </div>

        </form>

    </div>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>