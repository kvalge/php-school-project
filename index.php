<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="dashboard-page">

<?php include 'menu.html';

require_once 'controller.php';

$taskCount = 0;

?>

<div class="index-container">

    <div class="employee-container">

        <div class="title">Employees</div>
        <?php foreach (getEmployees() as $key => $employeeRow) : ?>
            <?php $employee = explode(',', $employeeRow) ?>
            <div class="list-container">
                <div class="info-text">
                    <div>
                        <span data-employee-id="<?php echo $employee[0] ?>"><?php print $employee[1] . ' ' . $employee[2]; ?></span>
                    </div>
                    <div>
                        <?php echo $employee[3] ?>
                    </div>
                    <br>
                </div>
                <div class="info-update">
                        <span id="employee-task-count-<?php echo $employee[0] ?>"><?php echo findNumberOfTasks($employee[0]); ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="task-container">

        <div class="title">Tasks</div>

        <?php foreach (getTasks() as $key => $taskRow) : ?>
            <?php $task = explode(',', $taskRow) ?>
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
                    <button class="state <?php echo $task[4]; ?>"><span
                                id="task-state-<?php echo $task[0]; ?>"><?php echo $task[4]; ?></span></button>
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
