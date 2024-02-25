<?php

function getDaysUnderTempDictionary(float $targetTemp): array {
    $inputFile = fopen(__DIR__ . '/data/temperatures-filtered.csv', "r");

    $temperatureDict = [];

    if ($inputFile !== false) {
        while (!feof($inputFile)) {
            $dict = fgetcsv($inputFile);

            if ($dict && floatval($dict[4]) <= $targetTemp) {
                if (array_key_exists(intval($dict[0]), $temperatureDict)) {
                    $temperatureDict[$dict[0]] += 1 / 24;
                } else {
                    $temperatureDict[$dict[0]] = 1 / 24;
                }
            }
        }
    }

    foreach ($temperatureDict as &$value) {
        $value = round($value, 2);
    }
    fclose($inputFile);

    return $temperatureDict;
}

function dictToString(array $dict): string {
    if (empty($dict)) {
        return "";
    }
    $toString = "[";

    foreach ($dict as $key => $value) {
        $toString .= "$key => $value, ";
    }
    return substr($toString, 0, -2) . ']';
}
