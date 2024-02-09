<?php

$input = '[1, 4, 2, 0]';

var_dump(stringToIntegerList($input));
var_dump(stringToIntegerList($input) === [1, 4, 2, 0]);

function stringToIntegerList(string $input): array {
    $input = str_replace(['[', ']'], '', $input);
    $list = explode(', ', $input);
    $intList = [];

    foreach ($list as $item) {
        $intList[] = intval($item);
    }
    return $intList;
}

// check that the restored list is the same as the input list.
// var_dump($list === [1, 4, 2, 0]); // should print "bool(true)"

