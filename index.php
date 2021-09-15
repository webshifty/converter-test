<?php

require_once realpath(dirname(__FILE__) . '/vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader(realpath(dirname(__FILE__) . "/templates"));
$twig = new \Twig\Environment($loader, [
    //'cache' => realpath(dirname(__FILE__) . './compilation_cache'),
]);

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

echo $twig->render('home.html', ['name' => 'Fabien', 'exchangeRates' => $exchangeRates]);