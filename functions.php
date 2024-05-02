<?php


require_once 'Repository.php';

function addEmployee($firstName, $lastName, $position): void {
    $repository = new Repository();

    $newEmployee = new Employee(null, $firstName, $lastName, $position);

    $repository->saveEmployee($newEmployee);
}

function addTask($employeeId, $description, $estimate, $taskState): void {
    $repository = new Repository();

    $newTask = new Task(null, $employeeId, $description, $estimate, $taskState);

    $repository->saveTask($newTask);
}

function getEmployeeById($id): Employee {
    $repository = new Repository();

    return $repository->getEmployee($id);
}

function getTaskById($id): Task {
    $repository = new Repository();

    return $repository->getTask(intval($id));
}

function getEmployees(): array|string {
    $repository = new Repository();

    return $repository->getAllEmployees();
}

function getTasks(): false|array {
    $repository = new Repository();

    return $repository->getAllTasks();
}

function updateEmployee($id, $firstName, $lastName, $position): void {
    $repository = new Repository();

    $repository->updateEmployee($id, $firstName, $lastName, $position);
}

function updateTask($id, $employeeId, $description, $estimate, $state): void {
    $repository = new Repository();

    $repository->updateTask($id, $employeeId, $description, $estimate, $state);
}

function deleteEmployee($id): void {
    $repository = new Repository();

    $repository->deleteEmployee($id);
}

function deleteTask($id):void {
    $repository = new Repository();

    $repository->deleteTask($id);
}

function findNumberOfTasks(int $id) {
    $repository = new Repository();

    $taskCount = $repository->getNumberOfEmployeeTasks();

    foreach ($taskCount as $key => $value) {
        if ($key === $id) {
            return $value;
        }
    }
    return 0;
}

function getTaskState(mixed $completed, mixed $employeeId): string {
    $taskStateList = ['open', 'pending', 'closed'];

    if (!$completed) {
        if (!$employeeId) {
            return $taskStateList[0];
        } else {
            return $taskStateList[1];
        }
    }
    return $taskStateList[2];
}
