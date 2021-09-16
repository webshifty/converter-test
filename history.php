<?php
require_once (dirname(__FILE__) . '/vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as Capsule;

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(
            array(
                'type' => 'error',
                'text' => 'Request must come from Ajax'
            ));

        die($output);
    }

    $input_currency = filter_var(trim($_POST["input_currency"]), FILTER_SANITIZE_STRING);
    $input_currency_reverse = filter_var(trim($_POST["input_currency_reverse"]), FILTER_SANITIZE_STRING);
    $value = trim($_POST["value"]);
    $result = trim($_POST["result"]);

    $data = [
        'input_currency' => $input_currency,
        'input_currency_reverse' => $input_currency_reverse,
        'value' => $value,
        'result' => $result,
        'date' => \Illuminate\Support\Facades\Date::now(),
    ];
    Capsule::table('history')->insert($data);
}