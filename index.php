<?php
// Return jsons:
header('Content-Type: application/json');
require_once __DIR__ . '/vendor/autoload.php';

$klein = new Klein\Klein();

// connect to db:
$klein->respond(function ($request, $response, $service, $app) use ($klein) {
    $app->register('db', function () {
        return new PDO('pgsql:host=lamp.wlan.hwr-berlin.de;port=5432;dbname=csdb3;user=csdb3;password=csdb3');
    });
});

$klein->respond('GET', '/', function () {
    return "Hello World!";
});

$klein->respond('GET', '/questions', function ($request, $response, $service, $app) {
    $sql = 'SELECT * FROM quiz';
    return json_encode($app->db->query($sql)->fetchAll(PDO::FETCH_ASSOC));
});

$klein->dispatch();