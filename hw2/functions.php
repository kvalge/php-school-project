<?php

function displayEmployees() {
    $employeeList = [];
    $readData = fopen('hw2/employees.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $exploded = explode(',', $line);
        $employeeList[] = [urldecode($exploded[0]), urldecode($exploded[1])];
    }
    fclose($readData);

    $employees = $employeeList;
    include 'hw2/employee-list.php';
}

function displayTasks() {
    $taskList = [];
    $readData = fopen('hw2/tasks.txt', 'r');

    while (($line = fgets($readData)) !== false) {
        $exploded = explode(',', $line);

        $taskList[urldecode($exploded[0])] = $exploded[1];
    }
    fclose($readData);

    $tasks = [];
    if ($taskList) {
        $tasks = $taskList;
    }
    $tasks = $taskList;
    include 'hw2/task-list.php';
}
