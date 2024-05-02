<?php

require_once 'db-query.php';
require_once 'Employee.php';
require_once 'Task.php';

function createEmployee(string $firstName, string $lastName, string $position): Employee {
    return new Employee(null, $firstName, $lastName, $position);
}

function createTask($employeeId, $description, $estimate, $state): Task {
    return new Task(null, $employeeId, $description, $estimate, $state);
}

function getEmployeeById($id): Employee {
    return getEmployee(intval($id));
}

function getTaskById($id): Task {
    return getTask(intval($id));
}

function getEmployees(): array|string {
    return getAllEmployees();
}

function getTasks(): false|array {
    return getAllTasks();
}

function findNumberOfTasks(int $id) {
    $taskCount = countEmployeeTasks();

    foreach ($taskCount as $key => $value) {
        if ($key === $id) {
            return $value;
        }
    }
    return 0;
}

