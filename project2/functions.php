<?php

function displayEmployees() {
    $employeeList = [];
    $readData = fopen('project2/data/employees.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $decodedName = urldecode($line);
        $employeeList[] = $decodedName;
    }

    fclose($readData);

    $employees = $employeeList;
    include 'project2/pages/employee-list.php';
}

function displayTasks() {
    $taskList = [];
    $readData = fopen('project2/data/tasks.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $decodedTask = urldecode($line);
        $taskList[] = $decodedTask;
    }

    fclose($readData);

    $tasks = $taskList;
    include 'project2/pages/task-list.php';
}
