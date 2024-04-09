<?php

require_once 'db-connection.php';

function addEmployee(string $firstName, string $lastName, string $position): void {
    $conn = getConnection();

    $stmt = $conn->prepare('INSERT INTO employee (id, first_name, last_name, position) VALUES 
                                                               (DEFAULT, :firstName, :lastName, :position)');

    $stmt->bindValue(':firstName', $firstName);
    $stmt->bindValue(':lastName', $lastName);
    $stmt->bindValue(':position', $position);

    $stmt->execute();
}

function addTask(string $employeeId, string $description, int $estimate, string $state): void {
    $conn = getConnection();

    $stmt = $conn->prepare('INSERT INTO task (id, employee_id, description, estimate, state) VALUES
                                                                     (DEFAULT, :employeeId, :description, :estimate, :state)');

    $stmt->bindValue(':employeeId', empty($employeeId) ? null : $employeeId);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':estimate', $estimate);
    $stmt->bindValue(':state', $state);

    $stmt->execute();
}

function getAllEmployees(): false|array {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT * FROM employee');

    $stmt->execute();

    $employeeList = [];

    foreach ($stmt as $row) {
        $id = $row['id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $position = $row['position'];
        $employee = $id . ',' . $firstName . ',' . $lastName . ',' . $position;
        $employeeList[] = $employee;
    }

    return $employeeList;
}

function getEmployee(int $id): string {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT * FROM employee WHERE id = :id');

    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    $id = $employee['id'];
    $firstName = $employee['first_name'];
    $lastName = $employee['last_name'];
    $position = $employee['position'];

    return $id . ',' . $firstName . ',' . $lastName . ',' . $position;
}

function getAllTasks(): false|array {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT * FROM task');

    $stmt->execute();

    $taskList = [];

    foreach ($stmt as $row) {
        $id = $row['id'];
        $employeeId = $row['employee_id'];
        $description = $row['description'];
        $estimate = $row['estimate'];
        $state = $row['state'];
        $task = $id . ',' . $employeeId . ',' . $description . ',' . $estimate . ',' . $state;
        $taskList[] = $task;
    }

    return $taskList;
}

function deleteEmployee(int $id): void {
    $taskIdList = findTaskIdByEmployeeId($id);

    foreach ($taskIdList as $taskId) {
        updateTaskToNotAssigned($taskId);
    }

    $conn = getConnection();

    $stmt = $conn->prepare('DELETE FROM employee WHERE id = :id');

    $stmt->bindValue(':id', $id);

    $stmt->execute();
}

function deleteTask(int $id): void {
    $conn = getConnection();

    $stmt = $conn->prepare('DELETE FROM task WHERE id = :id');

    $stmt->bindValue(':id', $id);

    $stmt->execute();
}

function findEmployeeTasks(): array {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT employee.id as empId, task.employee_id as taskEmpId  FROM employee LEFT JOIN task ON employee.id = task.employee_id');

    $stmt->execute();

    $taskCount = [];

    foreach ($stmt as $row) {
        $employeeId = $row['empId'];
        $taskEmployeeId = $row['taskEmpId'];

        if (isset($taskCount[$employeeId])) {
            if ($taskEmployeeId) {
                $taskCount[$employeeId] += 1;
            }
        } else {
            if ($taskEmployeeId) {
                $taskCount[$employeeId] = 1;
            } else {
                $taskCount[$employeeId] = 0;
            }
        }

    }

    return $taskCount;
}

function findTaskIdByEmployeeId(int $id): array {
    $conn = getConnection();

    $stmt = $conn->prepare('SELECT * FROM task WHERE employee_id = :id');

    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $taskIdList = [];

    foreach ($stmt as $row) {
        $taskIdList[] = $row['id'];
    }

    return $taskIdList;
}

function updateTaskToNotAssigned(int $id): void {
    $conn = getConnection();

    $stmt = $conn->prepare('UPDATE task SET employee_id = NULL, state = "open" WHERE id = :id');

    $stmt->bindValue(':id', $id);

    $stmt->execute();
}

function updateEmployee(int $id, string $firstName, string $lastName, string $position): void {
    $conn = getConnection();

    $stmt = $conn->prepare('UPDATE employee SET
                    first_name = :firstName,
                    last_name = :lastName,
                    position = :position 
                WHERE id = :id');

    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':firstName', $firstName);
    $stmt->bindValue(':lastName', $lastName);
    $stmt->bindValue(':position', $position);

    $stmt->execute();
}

function updateTask(int $id, int $employeeId, string $description, int $estimate, string $taskState): void {
    $conn = getConnection();

    $stmt = $conn->prepare('UPDATE task SET
                    employee_id = :employeeId,
                    description = :description,
                    estimate = :estimate, 
                    state = :state 
                WHERE id = :id');

    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':employeeId', $employeeId);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':estimate', $estimate);
    $stmt->bindValue(':state', $taskState);

    $stmt->execute();
}
