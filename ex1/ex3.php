<?php

$list = [1, 2, 3];

print listToString($list);

function listToString(array $list): string {
    return '[' . join(", ", $list) . ']';
}






