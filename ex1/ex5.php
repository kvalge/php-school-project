<?php

$sampleData = [
    ['type' => 'apple', 'weight' => 0.21],
    ['type' => 'orange', 'weight' => 0.18],
    ['type' => 'pear', 'weight' => 0.16],
    ['type' => 'apple', 'weight' => 0.22],
    ['type' => 'orange', 'weight' => 0.15],
    ['type' => 'pear', 'weight' => 0.19],
    ['type' => 'apple', 'weight' => 0.09],
    ['type' => 'orange', 'weight' => 0.24],
    ['type' => 'pear', 'weight' => 0.13],
    ['type' => 'apple', 'weight' => 0.25],
    ['type' => 'orange', 'weight' => 0.08],
    ['type' => 'pear', 'weight' => 0.20],
];

function getAverageWeightsByType(array $list): array {
    $dict = [];
    $fruitList = [];

    foreach ($list as $each) {
        $type = $each['type'];
        $weight = $each['weight'];
        $fruitList[] = $type;

        if (array_key_exists($type, $dict)) {
            $dict[$type] += $weight;
        } else {
            $dict[$type] = $weight;
        }
    }

    $resultDict = [];

    foreach ($dict as $key => $value) {
        $countFruits = array_count_values($fruitList);
        $count = $countFruits[$key];
        $resultDict[$key] = round($value / $count, 2);
    }
    return $resultDict;
}
