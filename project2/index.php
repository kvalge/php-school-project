<?php


ini_set('display_errors', '1');

require_once 'functions.php';

$command = $_GET['command'] ?? 'show-dashboard';
$page = $_GET['page'] ?? 'dashboard';
$command = $_POST['command'] ?? 'show-dashboard';
$inserted_data = $_POST['submitButton'];
$firstName = $_POST['firstName'] ?? null;
$lastName = $_POST['lastName'] ?? null;
$description = $_POST['description'] ?? null;
$estimate = $_POST['estimate'] ?? null;

if ($command === 'show-dashboard' && !$inserted_data) {
    if ($page === 'dashboard') {
        include 'pages/dashboard.php';
    } elseif ($page == 'employee-list') {
        displayEmployees();
    } elseif ($page === 'task-list') {
        displayTasks();
    } elseif ($page === 'employee-form') {
        include 'pages/employee-form.php';
    } elseif ($page === 'task-form') {
        include 'pages/task-form.php';
    }
}

if ($inserted_data === 'employee') {
    $encodedName = urlencode($firstName . ',' . $lastName);
    $data = fopen('data/employees.txt', 'a');
    fwrite($data, $encodedName . "\n");
    fclose($data);

    $page = 'employee-list';
    displayEmployees();

} elseif ($inserted_data === 'task') {
    $encodedName = urlencode($description . ',' . $estimate);
    $data = fopen('data/tasks.txt', 'a');
    fwrite($data, $encodedName . "\n");
    fclose($data);

    displayTasks();
}
