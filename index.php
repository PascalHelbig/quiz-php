<?php
// Return jsons:
header('Content-Type: application/json');

$pdo = new PDO('pgsql:host=lamp.wlan.hwr-berlin.de;port=5432;dbname=csdb3;user=csdb3;password=csdb3');

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

echo 'Hello World!';