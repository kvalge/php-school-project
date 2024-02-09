<?php

function getDaysUnderTemp(int $targetYear, float $targetTemp): float {
    $inputFile = fopen("data/temperatures-filtered.csv", "r");

    $countHours = 0;

    while (!feof($inputFile)) {
        $dict = fgetcsv($inputFile);

        if (intval($dict[0]) === $targetYear && floatval($dict[4]) <= $targetTemp) {
            $countHours++;
        }
    }
    return round($countHours / 24, 2);
}

print getDaysUnderTemp(2021, -10);
