<?php


ini_set('display_errors', '1');

require_once 'functions.php';

$id = $_POST['id'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$position = $_POST['position'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;
$employeeId = $_POST['employeeId'] ?? null;
$completed = $_POST['isCompleted'] ?? null;

$taskStateList = ['open', 'pending', 'closed'];

$inserted_data = '';
if (isset($_POST['submitButton'])) {
    $inserted_data = $_POST['submitButton'];
}

if ($inserted_data === 'employee') {
    $message = '';

    if (strlen($firstName) < 1 || strlen($firstName) > 21) {
        $message = 'Length of the first name should be 1 - 21!';
        include 'employee-form.php';
        exit();

    } elseif (strlen($lastName) < 2 || strlen($lastName) > 22) {
        $message = 'Length of the last name should be 2 - 22!';
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
    if (strlen($description) < 5 || strlen($description) > 40) {
        $message = 'Length of the description should be 5 - 40!';
        include 'task-form.php';
        exit();

    } else {
        $taskState = "";

        if (!$completed) {
            if (!$employeeId) {
                $taskState = $taskStateList[0];
            } else {
                $taskState = $taskStateList[1];
            }
        } else {
            $taskState = $taskStateList[2];
        }

        $message = '';

        if ($id) {
            updateTask(intval($id), intval($employeeId), $description, intval($estimate), $taskState);
            $message = 'Task is updated!';
        } else {
            $task = createTask($employeeId, $description, $estimate, $taskState);
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
