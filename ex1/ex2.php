<?php


$list = [1, 2, 3, 2, 6];

function isInList($list, $target): bool {
    foreach ($list as $l) {
        if ($l === $target) {
            return true;
        }
    }
    return false;
}

var_dump(isInList($list, 2));




