<?php


ini_set('display_errors', '1');

require_once 'functions.php';
require_once 'validation.php';
require_once 'vendor/tpl.php';

$command = $_GET['command'] ?? 'dashboard';

$insertedData = $_POST['submitButton'] ?? null;
$deleteData = $_POST['deleteButton'] ?? null;

$id = $_GET['id'] ?? null;
//$id = $_POST['id'] ?? null;
$firstName = $_GET['firstName'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_GET['lastName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$position = $_GET['position'] ?? null;
$position = $_POST['position'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;
$employeeId = $_POST['employeeId'] ?? null;
$completed = $_POST['isCompleted'] ?? null;

$employees = getEmployees();
$tasks = getTasks();

$positions = ["Manager", "Designer", "Developer"];

if ($insertedData === 'employee') {
    if (validateFirstName($firstName)) {
        $message = validateFirstName($firstName);
        $data = [
            'message' => $message,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'position' => $position,
            'positions' => $positions
        ];

        print renderTemplate('employee-form.html', $data);

    } elseif (validateLastName($lastName)) {
        $message = validateLastName($lastName);
        $data = [
            'message' => $message,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'position' => $position,
            'positions' => $positions
        ];

        print renderTemplate('employee-form.html', $data);

    } else {
        $message = '';

        if ($id) {
            updateEmployee(intval($id), $firstName, $lastName, $position);

            $message = 'Employee is updated!';

        } else {
            addEmployee($firstName, $lastName, $position);

            $message = 'Employee is added!';
        }

        $data = [
            'employees' => $employees,
            'message' => $message
        ];

        print renderTemplate('employee-list.html', $data);
    }

} elseif ($insertedData === 'task') {
    if (validateTaskDescription($description)) {
        $message = validateTaskDescription($description);

        $data = ['message' => $message];

        print renderTemplate('task-form.php', $data);

    } else {
        $message = '';

        $taskState = getTaskState($completed, $employeeId);

        if ($id) {
            updateTask(intval($id), intval($employeeId), $description, intval($estimate), $taskState);

            $message = 'Task is updated!';
        } else {
            addTask(intval($employeeId), $description, intval($estimate), $taskState);

            $message = 'Task is added!';
        }

        $data = ['message' => $message];

        print renderTemplate('task-list.html', $data);
    }

} else if ($deleteData) {
    if ($deleteData === 'deleteEmployee') {
        deleteEmployee(intval($_POST['employeeId']));

        $message = 'Employee is Deleted!';

        $data = [
            'employees' => $employees,
            'message' => $message
        ];

        print renderTemplate('employee-list.html', $data);

    } elseif ($deleteData === 'deleteTask') {
        deleteTask(intval($_POST['taskId']));

        $message = 'Task is Deleted!';

        $data = ['message' => $message];

        print renderTemplate('task-list.html', $data);

    }

} else if ($command === 'dashboard') {
    $data = [
        'employees' => $employees,
        'tasks' => $tasks,
        'taskCount' => 0
    ];

    print renderTemplate('dashboard.html', $data);

} else if ($command === 'employee_list') {
    $data = [
        'employees' => $employees,
    ];
    print renderTemplate('employee-list.html', $data);

} else if ($command === 'employee_form') {
    $employee = null;
    if ($id) {
        $employee = getEmployeeById($id);
    }

    // Remove position from drop down selection list if it is already employee's position
    if ($employee) {
        if (($key = array_search($employee->position, $positions)) !== false) {
            unset($positions[$key]);
        }
    }

    $data = [
        'firstName' => $employee->firstName ?? null,
        'lastName' => $employee->lastName ?? null,
        'position' => $employee->position ?? null,
        'positions' => $positions
    ];
    print renderTemplate('employee-form.html', $data);


} else if ($command === 'task_list') {
    $data = [
        'tasks' => $tasks,
    ];
    print renderTemplate('task-list.html', $data);

} else if ($command === 'task_form') {
    include 'task-form.php';
}
