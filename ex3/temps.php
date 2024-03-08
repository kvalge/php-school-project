<?php

ini_set('display_errors', '1');

require_once '../ex1/ex7.php';
require_once '../ex2/functions.php';

$command = $_GET['command'] ?? 'show-form';
$page = $_GET['page'] ?? 'days-under-temp';
$command = $_POST['command'] ?? 'show-form';
$inputYear = $_POST['year'] ?? null;
$inputTemp = $_POST['temp'] ?? null;


if ($command === 'show-form') {
    if ($page === 'days-under-temp') {
        include 'pages/days-under-temp.php';
    } else {
        include 'pages/avg-winter-temp.php';
    }

} else if ($command === 'days-under-temp') {
    $getDaysUnderTempResult = getDaysUnderTemp($inputYear, $inputTemp);

    $message = $getDaysUnderTempResult;

    include 'pages/result.php';

} else if ($command === 'avg-winter-temp') {
    $explode = explode('/', $inputYear);
    $getAvWinterTempResult = getAverageWinterTemp($explode[0], $explode[1]);

    $message = $getAvWinterTempResult;

    include 'pages/result.php';

} else {
    throw new Error('unknown command: ' . $command);
}
