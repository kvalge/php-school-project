<?php


ini_set('display_errors', '1');

require_once 'hw2/functions.php';

$command = $_GET['command'] ?? 'show-dashboard';
$page = $_GET['page'] ?? 'dashboard';
$command = $_POST['command'] ?? 'show-dashboard';

$inserted_data = '';
if (isset($_POST['submitButton'])) {
    $inserted_data = $_POST['submitButton'];
}

$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;

if ($command === 'show-dashboard' && !$inserted_data) {
    if ($page === 'dashboard') {
        include 'hw2/dashboard.php';
    } elseif ($page == 'employee-list') {
        getEmployees();
    } elseif ($page === 'task-list') {
        getTasks();
    } elseif ($page === 'employee-form') {
        include 'hw2/employee-form.php';
    } elseif ($page === 'task-form') {
        include 'hw2/task-form.php';
    }
}

if ($inserted_data === 'employee') {
    $encodedName = urlencode($firstName) . ',' . urlencode($lastName) . "\n";
    $data = fopen('hw2/employees.txt', 'a');
    fwrite($data, $encodedName);
    fclose($data);

    $page = 'employee-list';
    getEmployees();

} elseif ($inserted_data === 'task') {
    $encodedName = urlencode($description) . ',' . $estimate . "\n";
    $data = fopen('hw2/tasks.txt', 'a');
    fwrite($data, $encodedName);
    fclose($data);

    getTasks();
}
