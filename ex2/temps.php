<?php

require_once '../ex1/ex7.php'; // use existing code
require_once '../ex2/functions.php';
require_once 'functions.php'; // separate functions from main program

$opts = getopt('c:y:t:', ['command:', 'year:', 'temp:']);

$command = $opts['command'] ?? $opts['c'] ?? null;
$year = $opts['year'] ?? $opts['y'] ?? null;
$temp = $opts['temp'] ?? $opts['t'] ?? null;

if ($command === 'days-under-temp') {
    if (!$year || !$temp) {
        showError('some of parameters are missing');
    }
    print getDaysUnderTemp($year, $temp);
}

else if ($command === 'days-under-temp-dict') {
    if (!$temp) {
        showError('temperature parameter is missing');
    }
    print dictToString(getDaysUnderTempDictionary(-5));

} else if ($command === 'avg-winter-temp') {
    if (!$year) {
        showError('year parameter is missing');
    }
    $explode = explode('/', $year);

    print getAverageWinterTemp($explode[0], $explode[1]);


} else {
    showError('command is missing or is unknown');
}

function showError(string $message): void {
    fwrite(STDERR, $message . PHP_EOL);
    exit(1);
}
