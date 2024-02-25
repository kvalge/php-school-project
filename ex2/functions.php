<?php

function getAverageWinterTemp(int $winterStartYear, int $winterEndYear): float {
    $inputFile = fopen('../ex1/data/temperatures-filtered.csv', "r", "r");

    $count = 0;
    $temp = 0.0;

    while (!feof($inputFile)) {
        $dict = fgetcsv($inputFile);

        if ($dict && intval($dict[0]) === $winterStartYear && intval($dict[1]) == 12) {
            $temp += $dict[4];
            $count++;

        }
        if ($dict && intval($dict[0]) === $winterEndYear && (intval($dict[1]) == 1 || intval($dict[1] == 2))) {
            $temp += $dict[4];
            $count++;
        }
    }
    fclose($inputFile);

    return round($temp / $count, 2);
}
