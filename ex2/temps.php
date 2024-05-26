<?php

require_once '../ex1/ex7.php';
require_once '../ex1/ex8.php';
require_once '../ex2/functions.php';

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
    print dictToString(getDaysUnderTempDictionary($temp));

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

// terminal commands:
// php temps.php --command days-under-temp --year 2023 --temp -5
// php temps.php --command days-under-temp-dict --temp -5
// php temps.php --command avg-winter-temp --year 2022/2023
