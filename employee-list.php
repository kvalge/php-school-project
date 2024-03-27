<?php

require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee list</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="employee-list-page">

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

    <div class="title">Employees</div>
    <?php foreach (getEmployees() as $key => $employee) : ?>
        <div class="list-container">
            <div>
                <div data-employee-id="<?php $employee[0] ?>">
                    <?php echo $employee[1] . ' ' . $employee[2]; ?>
                </div>
                <div class="edit">
                    <a id="employee-edit-link-<?php $employee[0] ?>"
                       href="employee-form.php?id=<?php echo $employee[0]; ?>&first_name=<?php echo urlencode($employee[1]); ?>&last_name=<?php echo urlencode($employee[2]); ?>">Edit</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="footer">
    <?php include 'menu.html' ?>
</div>

</body>

</html>