<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="dashboard-page">

<?php include 'menu.html';

require_once 'functions.php';

$taskCount = 0;

$employees = getEmployees();
$tasks = getTasks();

?>

<div class="index-container">

    <div class="employee-container">

        <div class="title">Employees</div>
        <?php foreach ($employees as $employee) : ?>
            <div class="list-container">
                <div class="info-text">
                    <div>
                        <span data-employee-id="<?php echo $employee->id ?>"><?php print $employee->firstName . ' ' . $employee->lastName; ?></span>
                    </div>
                    <div>
                        <?php echo $employee->position ?>
                    </div>
                    <br>
                </div>
                <div class="info-update">
                    <span id="employee-task-count-<?php echo $employee->id ?>"><?php echo findNumberOfTasks($employee->id); ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="task-container">

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
                    <button class="state <?php echo $task->state; ?>"><span
                            id="task-state-<?php echo $task->id; ?>"><?php echo $task->state; ?></span></button>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="footer">
    <?php include 'footer.html' ?>
</div>

</body>

</html>

