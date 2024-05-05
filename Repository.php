<?php

require_once 'db-connection.php';
require_once 'Employee.php';
require_once 'Task.php';

class Repository
{
    public ?PDO $conn = null;

    function createConnection(): ?PDO {
        if ($this->conn === null) {
            $this->conn = getConnection();
        }
        return $this->conn;
    }

    function saveEmployee(Employee $employee): void {
        $stmt = $this->createConnection()->prepare('INSERT INTO employee (id, first_name, last_name, position) VALUES 
                                                               (DEFAULT, :firstName, :lastName, :position)');

        $stmt->bindValue(':firstName', $employee->firstName);
        $stmt->bindValue(':lastName', $employee->lastName);
        $stmt->bindValue(':position', $employee->position);

        $stmt->execute();
    }

    function saveTask(Task $task): void {
        $stmt = $this->createConnection()->prepare('INSERT INTO task (id, employee_id, description, estimate, state) VALUES
                                                                     (DEFAULT, :employeeId, :description, :estimate, :state)');

        $stmt->bindValue(':employeeId', empty($task->employeeId) ? null : $task->employeeId);
        $stmt->bindValue(':description', $task->description);
        $stmt->bindValue(':estimate', $task->estimate);
        $stmt->bindValue(':state', $task->state);

        $stmt->execute();
    }

    function getAllEmployees(): false|array {
        $stmt = $this->createConnection()->prepare('SELECT * FROM employee');

        $stmt->execute();

        $employeeList = [];
        foreach ($stmt as $row) {

            [$id, $firstName, $lastName, $position] = $row;

            $employee = new Employee($id, $firstName, $lastName, $position);

            $employeeList[] = $employee;
        }
        return $employeeList;
    }

    function getEmployee(int $id): Employee {
        $stmt = $this->createConnection()->prepare('SELECT * FROM employee WHERE id = :id');

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $employee['id'];
        $firstName = $employee['first_name'];
        $lastName = $employee['last_name'];
        $position = $employee['position'];

        return new Employee($id, $firstName, $lastName, $position);
    }

    function getAllTasks(): false|array {
        $stmt = $this->createConnection()->prepare('SELECT * FROM task');

        $stmt->execute();

        $taskList = [];
        foreach ($stmt as $row) {
            [$id, $employeeId, $description, $estimate, $state] = $row;

            $task = new Task($id, $employeeId, $description, $estimate, $state);

            $taskList[] = $task;
        }
        return $taskList;
    }

    function getTask(int $id): Task {
        $stmt = $this->createConnection()->prepare('SELECT * FROM task WHERE id = :id');

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $task['id'];
        $employeeId = $task['employee_id'];
        $description = $task['description'];
        $estimate = $task['estimate'];
        $state = $task['state'];

        return new Task($id, $employeeId, $description, $estimate, $state);
    }

    function deleteEmployee(int $id): void {
        $tasks = $this->findTaskByEmployeeId($id);

        // Update the task that is given to the employee who will be deleted
        foreach ($tasks as $task) {
            $updatedTask = new Task($task->id, null, $task->description, $task->estimate, 'open');
            $this->updateTask($updatedTask);
        }

        $stmt = $this->createConnection()->prepare('DELETE FROM employee WHERE id = :id');

        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    function deleteTask(int $id): void {
        $stmt = $this->createConnection()->prepare('DELETE FROM task WHERE id = :id');

        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    function findTaskByEmployeeId(int $id): array {
        $stmt = $this->createConnection()->prepare('SELECT * FROM task WHERE employee_id = :id');

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        $taskList = [];

        foreach ($stmt as $row) {
            $id = $row['id'];
            $employeeId = $row['employee_id'];
            $description = $row['description'];
            $estimate = $row['estimate'];
            $state = $row['state'];
            $task = new Task($id, $employeeId, $description, $estimate, $state);
            $taskList[] = $task;
        }
        return $taskList;
    }

    function updateEmployee(Employee $employee): void {
        $stmt = $this->createConnection()->prepare('UPDATE employee SET
                    first_name = :firstName,
                    last_name = :lastName,
                    position = :position 
                WHERE id = :id');

        $stmt->bindValue(':id', $employee->id);
        $stmt->bindValue(':firstName', $employee->firstName);
        $stmt->bindValue(':lastName', $employee->lastName);
        $stmt->bindValue(':position', $employee->position);

        $stmt->execute();
    }

    function updateTask(Task $task): void {
        $stmt = $this->createConnection()->prepare('UPDATE task SET
                    employee_id = :employeeId,
                    description = :description,
                    estimate = :estimate, 
                    state = :state 
                WHERE id = :id');

        $stmt->bindValue(':id', $task->id);
        $stmt->bindValue(':employeeId', $task->employeeId);
        $stmt->bindValue(':description', $task->description);
        $stmt->bindValue(':estimate', $task->estimate);
        $stmt->bindValue(':state', $task->state);

        $stmt->execute();
    }

    function getEmployeesAndNumberOfTasks(): array {
        $stmt = $this->createConnection()->prepare('SELECT employee.id as empId, 
       task.employee_id as taskEmpId, 
       employee.first_name, 
       employee.last_name, 
       employee.position  
FROM employee LEFT JOIN task ON employee.id = task.employee_id');

        $stmt->execute();

        $taskCount = [];

        foreach ($stmt as $row) {
            [$employeeId, $taskEmployeeId, $firstName, $lastName, $position] = $row;

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

    function getNumberOfEmployeeTasks(): array {
        $stmt = $this->createConnection()->prepare('SELECT employee.id as empId, task.employee_id as taskEmpId  FROM employee LEFT JOIN task ON employee.id = task.employee_id');

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
}
