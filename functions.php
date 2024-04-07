<?php


ini_set('display_errors', '1');

const EMPLOYEES_FILE = 'employees.txt';
const TASKS_FILE = 'tasks.txt';
const NEXT_EMPLOYEE_ID_FILE = 'next-employee-id.txt';
const NEXT_TASK_ID_FILE = 'next-task-id-txt';


$id = $_POST['id'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$position = $_POST['position'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;
$employeeId = $_POST['employeeId'] ?? null;
$completed = $_POST['completed'] ?? null;

$taskStateList = ['open', 'pending', 'closed'];

$inserted_data = '';
if (isset($_POST['submitButton'])) {
    $inserted_data = $_POST['submitButton'];
}

if ($inserted_data === 'employee') {
    if (strlen($firstName) < 1 || strlen($firstName) > 21) {
        $message = 'Length of the first name should be 1 - 21!';
        include 'employee-form.php';
        exit();
    } elseif (strlen($lastName) < 2 || strlen($lastName) > 22) {
        $message = 'Length of the last name should be 2 - 22!';
        include 'employee-form.php';
        exit();
    } else {
        $newId = "";
        $employees = getEmployees();
        foreach ($employees as $employee) {
            if ($id === $employee[0]) {
                deleteEmployee($id);
                $newId = $id;
            }
        }

        if ($newId === "") {
            $newId = getNewId(NEXT_EMPLOYEE_ID_FILE);
        }

        $encodedName = $newId . ',' . urlencode($firstName) . ',' . urlencode($lastName) . ',' . urlencode($position) . "\n";
        writeData(EMPLOYEES_FILE, $encodedName);

        $message = 'Employee is added!';
        header('Location: employee-list.php?message=' . urlencode($message));
    }

} elseif ($inserted_data === 'task') {
    $description = trim($description);
    if (strlen($description) < 5 || strlen($description) > 40) {
        $message = 'Length of the description should be 5 - 40!';
        include 'task-form.php';
        exit();
    } else {
        $newId = "";
        $tasks = getTasks();
        foreach ($tasks as $task) {
            if ($id === $task[0]) {
                deleteTask($id);
                $newId = $id;
            }
        }
        if ($newId === "") {
            $newId = getNewId(NEXT_TASK_ID_FILE);
        }

        $taskState = "";
        if (!$completed) {
            if (!$employeeId) {
                $taskState = $taskStateList[0];
                error_log('0:' . $taskStateList[0]);
            } else {
                $taskState = $taskStateList[1];
                error_log('1:' . $taskStateList[1]);
            }
        } else {
            $taskState = $taskStateList[2];
            error_log('2:' . $taskStateList[2]);
        }

        $encodedTask = $newId . ',' . urlencode($description) . ',' . $estimate . ',' . $employeeId . ',' . $taskState . "\n";
        writeData(TASKS_FILE, $encodedTask);

        $message = 'Task is added!';
        header('Location: task-list.php?message=' . urlencode($message));
    }
}

if (isset($_POST['deleteButton'])) {
    if ($_POST['employeeId']) {
        error_log('post func: ' . $_POST['employeeId']);
        deleteEmployee($_POST['employeeId']);

        $message = 'Employee is Deleted!';
        header('Location: employee-list.php?message=' . urlencode($message));

    } elseif ($_POST['taskId']) {
        deleteTask($_POST['taskId']);

        $message = 'Task is Deleted!';
        header('Location: task-list.php?message=' . urlencode($message));
    }
}

function getEmployeeById($id): array {
    $employee = [];

    $readData = fopen(EMPLOYEES_FILE, 'r');

    if ($readData) {
        while (($line = fgets($readData)) !== false) {
            $exploded = explode(',', $line);
            if ($exploded[0] == $id) {
                $employee[] = $exploded[0] ?? '';
                $employee[] = isset($exploded[1]) ? urldecode($exploded[1]) : '';
                $employee[] = isset($exploded[2]) ? urldecode($exploded[2]) : '';
                $employee[] = isset($exploded[3]) ? urldecode($exploded[3]) : '';
            }
        }
        fclose($readData);
    }
    return $employee;
}

function getEmployees(): array|string {
    $employeeList = [];
    $readData = fopen(EMPLOYEES_FILE, 'r');

    if ($readData) {
        while (($line = fgets($readData)) !== false) {
            $exploded = explode(',', $line);

            $employeeList[] = [isset($exploded[0]) ? $exploded[0] : '',
                isset($exploded[1]) ? urldecode($exploded[1]) : '',
                isset($exploded[2]) ? urldecode($exploded[2]) : '',
                isset($exploded[3]) ? urldecode($exploded[3]) : ''];
        }
        fclose($readData);

        return $employeeList;
    }
    return '';
}

function getTasks(): array|string {
    $taskList = [];
    $readData = fopen(TASKS_FILE, 'r');

    if ($readData) {
        while (($line = fgets($readData)) !== false) {
            $exploded = explode(',', $line);

            $taskList[] = [$exploded[0] ?? '',
                isset($exploded[1]) ? urldecode($exploded[1]) : '',
                isset($exploded[2]) ? urldecode($exploded[2]) : '',
                $exploded[3] ?? '',
                $exploded[4] ?? ''];
        }
        fclose($readData);

        return $taskList;
    }
    return '';
}

function deleteEmployee(string $id): void {
    $employees = getEmployees();
    $data = [];
    foreach ($employees as $employee) {
        if ($employee[0] !== $id) {
            $encodedName = $employee[0] . ',' . urlencode($employee[1]) . ',' . urlencode($employee[2]) . ',' . urlencode($employee[3]) . "\n";
            $data[] = $encodedName;
        }
    }
    file_put_contents(EMPLOYEES_FILE, implode('', $data));
}

function deleteTask(string $id): void {
    $tasks = getTasks();
    $data = [];
    foreach ($tasks as $task) {
        if ($task[0] !== $id) {
            $encodedTask = $task[0] . ',' . urlencode($task[1]) . ',' . $task[2] . ',' . $task[3] . ',' . $task[4];
            $data[] = $encodedTask;
        }
    }
    file_put_contents(TASKS_FILE, implode('', $data));
}

function writeData(string $file, string $encodedData): void {
    $data = fopen($file, 'a');
    fwrite($data, $encodedData);
    fclose($data);
}

function getNewId(string $file): string {
    $id = file_get_contents($file);
    file_put_contents($file, intval($id) + 1);

    return $id;
}
