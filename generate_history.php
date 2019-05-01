<?php

// 過去の当選番号履歴を作成する

require_once './vendor/autoload.php';

$client = new Goutte\Client();

$numbers1 = [];

for ($i = 1; $i <= 1351; $i += 50) {
    $url = sprintf("http://www.takarakuji-loto.jp/loto6-mini/loto6%04d.html", $i);

    $crawler = $client->request('GET', $url);
    $numbers = [];
    $crawler->filter('table.resulttb > tbody > tr > td.bg1')->each(function($td) use (&$numbers, &$numbers1) {
        $text = trim($td->text());
        $text = str_replace("\n", "", $text);
        $text = str_replace("\r", "", $text);
        $text = str_replace("\t", "", $text);
        $text = str_replace("\x20", "", $text);
        if (preg_match('/^[\d]{4}年[\d]{1,2}月[\d]{1,3}日$/', $text, $matches)) {
            $numbers = [];
        }
        if (preg_match('/^[\d]{2}$/', $text, $matches) && count($numbers) < 6) {
            $numbers []= (int)$matches[0];
            if (count($numbers) == 6) {
                $numbers1 []= $numbers;
            }
        }
    });
}

file_put_contents("history.json", json_encode($numbers1));
