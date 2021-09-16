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

    $id = trim($_POST["id"]);
    $historySize = trim($_POST["history_size"]);

    $data = [
        'history_size' => $historySize
    ];

    Capsule::table('users')->where('id', '=', $id)->update($data);
}