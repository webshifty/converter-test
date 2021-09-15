<?php

require_once realpath(dirname(__FILE__) . '/vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;

$loader = new \Twig\Loader\FilesystemLoader(realpath(dirname(__FILE__) . "/templates"));
$twig = new \Twig\Environment($loader, [
    //'cache' => realpath(dirname(__FILE__) . './compilation_cache'),
]);

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'sql11.freemysqlhosting.net',
    'database' => 'sql11437529',
    'username' => 'sql11437529',
    'password' => 'N7JLxbwDUy',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();

$curl = new Curl\Curl();
$curl->get('https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies.json');
$exchangeRates = [];

if ($curl->error) {
    echo $curl->error_code;
}
else {
    $exchangeRates = json_decode($curl->response);
    print_r($exchangeRates);
}

$currencies = Capsule::table('currencies')->get();

print_r($currencies);

echo $twig->render('home.html', ['name' => 'Fabien', 'exchangeRates' => $exchangeRates]);