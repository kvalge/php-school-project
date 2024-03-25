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
                <textarea id="description" name="description" rows="3" cols="50"><?php if ($description): ?><?php echo $description; ?><?php endif; ?></textarea>
            </div>
            <br>
            <div>
                <label>Estimate </label>
                <input type="radio" name="estimate" value="1"> 1
                <input type="radio" name="estimate" value="2"> 2
                <input type="radio" name="estimate" value="3"> 3
                <input type="radio" name="estimate" value="4"> 4
                <input type="radio" name="estimate" value="5"> 5
            </div>
            <br>
            <div>
                <button type="submit" name="submitButton"
                        value="task">Save
                </button>
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