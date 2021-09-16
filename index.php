<?php

require_once (dirname(__FILE__) . '/vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;

include 'db.php';

$loader = new \Twig\Loader\FilesystemLoader(realpath(dirname(__FILE__) . "/templates"));
$twig = new \Twig\Environment($loader, [
    //'cache' => realpath(dirname(__FILE__) . './compilation_cache'),
]);

$currencies = Capsule::table('currencies')->where('enable', '=', '1')->get()->toArray();
$currenciesReverse = array_reverse($currencies);
$historySize = Capsule::table('users')->where('id', '=', '1')->first();
$history = Capsule::table('history')->orderBy('id','DESC')->limit($historySize->history_size)->get()->toArray();
$allCurrencies = Capsule::table('currencies')->get()->toArray();

echo $twig->render('home.html', ['name' => 'Fabien', 'currencies' => $currencies, 'currenciesReverse' => $currenciesReverse, 'history' => $history, 'allCurrencies' => $allCurrencies]);