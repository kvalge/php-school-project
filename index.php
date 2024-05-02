<?php


ini_set('display_errors', '1');

require_once 'functions.php';
require_once 'validation.php';

$command = null;

$id = $_POST['id'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$position = $_POST['position'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;
$employeeId = $_POST['employeeId'] ?? null;
$completed = $_POST['isCompleted'] ?? null;

$inserted_data = '';
if (isset($_POST['submitButton'])) {
    $inserted_data = $_POST['submitButton'];
} else {
    $command = $_GET['command'] ?? 'dashboard';
}

if ($command === 'dashboard') {
    include 'dashboard.php';
} else if ($command === 'employee_list') {
    include 'employee-list.php';
} else if ($command === 'employee_form') {
    include 'employee-form.php';
} else if ($command === 'task_list') {
    include 'task-list.php';
} else if ($command === 'task_form') {
    include 'task-form.php';
}

if ($inserted_data === 'employee') {
    if (validateFirstName($firstName)) {
        $message = validateFirstName($firstName);
        include 'employee-form.php';
        exit();

    } elseif (validateLastName($lastName)) {
        $message = validateLastName($lastName);
        include 'employee-form.php';
        exit();

    } else {
        if ($id) {
            updateEmployee(intval($id), $firstName, $lastName, $position);
            $message = 'Employee is updated!';
        } else {
            $newEmployee = createEmployee($firstName, $lastName, $position);

            saveEmployee($newEmployee);
            $message = 'Employee is added!';
        }

        header('Location: employee-list.php?message=' . urlencode($message));
    }

} elseif ($inserted_data === 'task') {
    if (validateTaskDescription($description)) {
        $message = validateTaskDescription($description);
        include 'task-form.php';
        exit();

    } else {
        $taskState = getTaskState($completed, $employeeId);

        if ($id) {
            updateTask(intval($id), intval($employeeId), $description, intval($estimate), $taskState);
            $message = 'Task is updated!';
        } else {
            $task = createTask(intval($employeeId), $description, intval($estimate), $taskState);
            saveTask($task);
            $message = 'Task is added!';
        }

        header('Location: task-list.php?message=' . urlencode($message));
    }
}

if (isset($_POST['deleteButton'])) {
    $buttonValue = $_POST['deleteButton'];
    if ($buttonValue === 'deleteEmployee') {
        deleteEmployee(intval($_POST['employeeId']));

        $message = 'Employee is Deleted!';
        header('Location: employee-list.php?message=' . urlencode($message));

    } elseif ($buttonValue === 'deleteTask') {
        deleteTask(intval($_POST['taskId']));

        $message = 'Task is Deleted!';
        header('Location: task-list.php?message=' . urlencode($message));
    }
}
