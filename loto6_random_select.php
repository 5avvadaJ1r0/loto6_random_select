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

// 過去の当選履歴に一致するパターンが有るか確認する

$contents = file_get_contents("history.json");
$histories = json_decode($contents, true);

foreach ($histories as $history) {
    if ($numbers[0] == (int)$history[0] && $numbers[1] == (int)$history[1] && $numbers[2] == (int)$history[2] &&
        $numbers[3] == (int)$history[3] && $numbers[4] == (int)$history[4] && $numbers[5] == (int)$history[5]) {
        var_dump("過去に同一の当選パターンがあります！！");
        break;
    }
}

print_r($numbers);
