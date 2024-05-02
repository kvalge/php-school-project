<?php
//
//require_once 'db-connection.php';
//require_once 'Employee.php';
//require_once 'Task.php';
//
//function saveEmployee(Employee $employee): void {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('INSERT INTO employee (id, first_name, last_name, position) VALUES
//                                                               (DEFAULT, :firstName, :lastName, :position)');
//
//    $stmt->bindValue(':firstName', $employee->firstName);
//    $stmt->bindValue(':lastName', $employee->lastName);
//    $stmt->bindValue(':position', $employee->position);
//
//    $stmt->execute();
//}
//
//function saveTask(Task $task): void {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('INSERT INTO task (id, employee_id, description, estimate, state) VALUES
//                                                                     (DEFAULT, :employeeId, :description, :estimate, :state)');
//
//    $stmt->bindValue(':employeeId', empty($task->employeeId) ? null : $task->employeeId);
//    $stmt->bindValue(':description', $task->description);
//    $stmt->bindValue(':estimate', $task->estimate);
//    $stmt->bindValue(':state', $task->state);
//
//    $stmt->execute();
//}
//
//function getAllEmployees(): false|array {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT * FROM employee');
//
//    $stmt->execute();
//
//    $employeeList = [];
//    foreach ($stmt as $row) {
//
//        [$id, $firstName, $lastName, $position] = $row;
//
//        $employee = new Employee($id, $firstName, $lastName, $position);
//
//        $employeeList[] = $employee;
//    }
//    return $employeeList;
//}
//
//function getEmployee(int $id): Employee {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT * FROM employee WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//
//    $stmt->execute();
//
//    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
//
//    $id = $employee['id'];
//    $firstName = $employee['first_name'];
//    $lastName = $employee['last_name'];
//    $position = $employee['position'];
//
//    return new Employee($id, $firstName, $lastName, $position);
//}
//
//function getAllTasks(): false|array {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT * FROM task');
//
//    $stmt->execute();
//
//    $taskList = [];
//    foreach ($stmt as $row) {
//        [$id, $employeeId, $description, $estimate, $state] = $row;
//
//        $task = new Task($id, $employeeId, $description, $estimate, $state);
//
//        $taskList[] = $task;
//    }
//    return $taskList;
//}
//
//function getTask(int $id): Task {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT * FROM task WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//
//    $stmt->execute();
//
//    $task = $stmt->fetch(PDO::FETCH_ASSOC);
//
//    $id = $task['id'];
//    $employeeId = $task['employee_id'];
//    $description = $task['description'];
//    $estimate = $task['estimate'];
//    $state = $task['state'];
//
//    return new Task($id, $employeeId, $description, $estimate, $state);
//}
//
//function deleteEmployee(int $id): void {
//    $tasks = findTaskByEmployeeId($id);
//
//    foreach ($tasks as $task) {
//        updateTask($task->id, $task->employeeId, $task->description, $task->estimate, $task->state);
//    }
//
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('DELETE FROM employee WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//
//    $stmt->execute();
//}
//
//function deleteTask(int $id): void {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('DELETE FROM task WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//
//    $stmt->execute();
//}
//
//function countEmployeeTasks(): array {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT employee.id as empId, task.employee_id as taskEmpId  FROM employee LEFT JOIN task ON employee.id = task.employee_id');
//
//    $stmt->execute();
//
//    $taskCount = [];
//
//    foreach ($stmt as $row) {
//        $employeeId = $row['empId'];
//        $taskEmployeeId = $row['taskEmpId'];
//
//        if (isset($taskCount[$employeeId])) {
//            if ($taskEmployeeId) {
//                $taskCount[$employeeId] += 1;
//            }
//        } else {
//            if ($taskEmployeeId) {
//                $taskCount[$employeeId] = 1;
//            } else {
//                $taskCount[$employeeId] = 0;
//            }
//        }
//    }
//    return $taskCount;
//}
//
//function findTaskByEmployeeId(int $id): array {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('SELECT * FROM task WHERE employee_id = :id');
//
//    $stmt->bindValue(':id', $id);
//
//    $stmt->execute();
//
//    $taskList = [];
//
//    foreach ($stmt as $row) {
//        $id = $row['id'];
//        $employeeId = $row['employee_id'];
//        $description = $row['description'];
//        $estimate = $row['estimate'];
//        $state = $row['state'];
//        $task = new Task($id, $employeeId, $description, $estimate, $state);
//        $taskList[] = $task;
//    }
//    return $taskList;
//}
//
//function updateEmployee(int $id, string $firstName, string $lastName, string $position): void {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('UPDATE employee SET
//                    first_name = :firstName,
//                    last_name = :lastName,
//                    position = :position
//                WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//    $stmt->bindValue(':firstName', $firstName);
//    $stmt->bindValue(':lastName', $lastName);
//    $stmt->bindValue(':position', $position);
//
//    $stmt->execute();
//}
//
//function updateTask(int $id, int $employeeId, string $description, int $estimate, string $taskState): void {
//    $conn = getConnection();
//
//    $stmt = $conn->prepare('UPDATE task SET
//                    employee_id = :employeeId,
//                    description = :description,
//                    estimate = :estimate,
//                    state = :state
//                WHERE id = :id');
//
//    $stmt->bindValue(':id', $id);
//    $stmt->bindValue(':employeeId', $employeeId);
//    $stmt->bindValue(':description', $description);
//    $stmt->bindValue(':estimate', $estimate);
//    $stmt->bindValue(':state', $taskState);
//
//    $stmt->execute();
//}
