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
    $sql = 'SELECT * FROM highscore ORDER BY score ASC, timestamp ASC LIMIT 10';
    echo json_encode($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC));
    return;
}

if (isset($_POST['name']) && isset($_POST['score'])) {
    $name = $_POST['name'];
    $score = $_POST['score'];

    $stmt = $pdo->prepare('INSERT INTO highscore (name, score) VALUES (:name, :score)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':score', $score);
    echo $stmt->execute();
    return;
}

echo 'Hello World!';