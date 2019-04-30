<?php

define('SELECT_COUNT', 6);
define('SELECT_NUMBERS', 43);

$numbers = [];

while(count($numbers) < SELECT_COUNT) {
    $number = rand(1, SELECT_NUMBERS);
    if (!in_array($number, $numbers)) {
        $numbers []= $number;
    }
}

sort($numbers);

print_r($numbers);
