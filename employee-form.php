<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-form-page">

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
$firstName = isset($_GET['first_name']) ? urldecode($_GET['first_name']) : null;
$lastName = isset($_GET['last_name']) ? urldecode($_GET['last_name']) : null;

?>

<div class="container">

    <?php if ($message): ?>
        <div class="message-error" id="error-block"><?= $message ?></div>
    <?php endif; ?>

    <div class="title">Add Employee</div>
    <div class="form-container">
        <form method="post" action="functions.php">
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="firstName">First name:</label>
                <input type="text" name="firstName" id="firstName" placeholder="1-21 characters"
                    <?php if ($firstName): ?>
                        value="<?php echo $firstName; ?>"
                    <?php endif; ?>>
            </div>
            <br>
            <div>
                <label for="lastName">Last name:</label>
                <input type="text" name="lastName" id="lastName" placeholder="2-22 characters"
                    <?php if ($lastName): ?>
                        value="<?php echo $lastName; ?>"
                    <?php endif; ?>>
            </div>
            <br>
            <div>
                <label for="picture">Picture:</label>
                <button id="picture">Choose File</button>
                No file chosen
            </div>
            <br>
            <?php if ($id): ?>
                    <input type="hidden" name="employeeId" value="<?php echo $id; ?>">
                    <button type="submit" name="deleteButton" value="<?php echo $id; ?>">Delete</button>
            <?php endif; ?>

                <button type="submit" name="submitButton"
                        value="employee">Save
                </button>
        </form>
    </div>
</div>

<div class="footer">
    <hr>
    icd0007 Employee and Task Management Application
</div>
</body>

</html>