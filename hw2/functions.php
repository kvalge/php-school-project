<?php

function displayEmployees() {
    $employeeList = [];
    $readData = fopen('hw2/employees.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $decodedName = urldecode($line);
        $employeeList[] = $decodedName;
    }

    fclose($readData);

    $employees = $employeeList;
    include 'hw2/employee-list.php';
}

function displayTasks() {
    $taskList = [];
    $readData = fopen('hw2/tasks.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $decodedTask = urldecode($line);
        $taskList[] = $decodedTask;
    }

    fclose($readData);

    $tasks = $taskList;
    include 'hw2/task-list.php';
}
