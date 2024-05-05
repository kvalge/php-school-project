<?php


ini_set('display_errors', '1');

require_once 'functions.php';
require_once 'validation.php';
require_once 'vendor/tpl.php';

$command = $_GET['command'] ?? 'dashboard';

$insertedData = $_POST['submitButton'] ?? null;
$deleteData = $_POST['deleteButton'] ?? null;

$id = $_GET['id'] ?? null;
$idPost = $_POST['id'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$position = $_POST['position'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;
$employeeId = $_POST['employeeId'] ?? null;
$completed = $_POST['isCompleted'] ?? null;

$employees = getEmployees();
$tasks = getTasks();
$positions = getPositions();
$message = '';

if ($command === 'dashboard' && !$insertedData && !$deleteData) {
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

        // Remove the position from the dropdown selection list if it has already been pre-selected
        if (($key = array_search($employee->position, $positions)) !== false) {
            unset($positions[$key]);
        }
    }

    $data = [
        'id' => $employee->id ?? null,
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
    $task = null;
    $employee = null;

    if ($id) {
        $task = getTaskById(intval($id));
        $estimate = $task->estimate;

        if ($task->employeeId) {
            $employee = getEmployeeById($task->employeeId);
        }
        if ($task->state === 'closed') {
            $completed = 'completed';
        }
    }

    // Remove the name from the dropdown selection list if it has already been pre-selected
    if ($employee) {
        $key = array_search($employee, $employees);
        if ($key !== false) {
            unset($employees[$key]);
        }
    }

    $data = [
        'id' => $task->id ?? null,
        'description' => $task->description ?? null,
        'estimate' => intval($estimate) ?? null,
        'state' => $task->state ?? null,
        'completed' => $completed ?? null,
        'employee' => $employee ?? null,
        'employees' => $employees
    ];

    print renderTemplate('task-form.html', $data);
}

if ($insertedData === 'employee') {
    if (validateFirstName($firstName)) {
        $message = validateFirstName($firstName);

        // Remove the position from the dropdown selection list if it has already been pre-selected
        if ($position) {
            if (($key = array_search($position, $positions)) !== false) {
                unset($positions[$key]);
            }
        }

        $data = [
            'message' => $message,
            'id' => $idPost,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'position' => $position,
            'positions' => $positions
        ];

        print renderTemplate('employee-form.html', $data);

    } elseif (validateLastName($lastName)) {
        $message = validateLastName($lastName);

        // Remove the position from the dropdown selection list if it has already been pre-selected
        if ($position) {
            if (($key = array_search($position, $positions)) !== false) {
                unset($positions[$key]);
            }
        }

        $data = [
            'message' => $message,
            'id' => $idPost,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'position' => $position,
            'positions' => $positions
        ];

        print renderTemplate('employee-form.html', $data);

    } else {
        if ($idPost) {
            updateEmployee(intval($idPost), $firstName, $lastName, $position);

            $message = 'Employee is updated!';

        } else {
            addEmployee($firstName, $lastName, $position);

            $message = 'Employee is added!';
        }

        header('Location: index.php?command=employee_list');
        exit;
    }

} elseif ($insertedData === 'task') {
    if (validateTaskDescription($description)) {
        $message = validateTaskDescription($description);

        $employee = null;

        if ($employeeId) {
            $employee = getEmployeeById(intval($employeeId));
        }

        // Remove the name from the dropdown selection list if it has already been pre-selected
        $key = array_search($employee, $employees);
        if ($key !== false) {
            unset($employees[$key]);
        }

        $data = [
            'message' => $message,
            'employeeId' => $employeeId,
            'description' => $description,
            'estimate' => intval($estimate),
            'completed' => $completed,
            'employees' => $employees,
            'employee' => $employee,
            'id' => $idPost
        ];

        print renderTemplate('task-form.html', $data);

    } else {
        $message = '';

        $taskState = getTaskState($completed, $employeeId);

        if ($idPost) {
            updateTask(intval($idPost), intval($employeeId), $description, intval($estimate), $taskState);

            $message = 'Task is updated!';
        } else {
            addTask(intval($employeeId), $description, intval($estimate), $taskState);

            $message = 'Task is added!';
        }

        header('Location: index.php?command=task_list');
        exit;
    }
}

if ($deleteData === 'deleteEmployee') {
    deleteEmployee(intval($idPost));

    $employees = getEmployees();
    $message = 'Employee is Deleted!';

    $data = [
        'employees' => $employees,
        'message' => $message
    ];

    print renderTemplate('employee-list.html', $data);

} elseif ($deleteData === 'deleteTask') {
    deleteTask(intval($idPost));

    error_log("DEL_ID" . $idPost);

    $tasks = getTasks();
    $message = 'Task is Deleted!';

    $data = [
        'message' => $message,
        'tasks' => $tasks
    ];

    print renderTemplate('task-list.html', $data);
}
