<?php
// Return jsons:
header('Content-Type: application/json');

$_HOST = 'lamp.wlan.hwr-berlin.de';
$_PORT = 5432;
$_DB = 'csdb3';
$_USER = 'csdb3';
$_PASSWORD = 'csdb3';

$pdo = new PDO('pgsql:host='.$_HOST.';port='.$_PORT.';dbname='.$_DB.';user='.$_USER.';password='.$_PASSWORD);

if (isset($_GET['questions'])) {
    $sql = 'SELECT * FROM quiz';
    echo json_encode($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    return;
}

if (isset($_GET['categories'])) {
    $sql = 'SELECT * FROM category';
    echo json_encode($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    return;
}

if (isset($_GET['highscore'])) {
    $sql = 'SELECT * FROM highscore ORDER BY score DESC LIMIT 10';
    echo json_encode($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    return;
}

echo 'Hello World!';