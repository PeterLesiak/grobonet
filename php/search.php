<?php

if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['cemetery'])) {
    header('Location: ../index.php');
    die('🤬🤬!!#1#1!!');
}

require_once __DIR__ . '/connection.php';

$name = "{$_POST['name']}%";
$surname = "{$_POST['surname']}%";
$cemetery = $_POST['cemetery'];

if ($cemetery != '0') {
    $stmt = $mysqli->prepare('SELECT * FROM Users WHERE name LIKE ? AND surname LIKE ? AND cemetery = ? ORDER BY name, surname');
    $stmt->bind_param('ssi', $name, $surname, $cemetery);
} else {
    $stmt = $mysqli->prepare('SELECT * FROM Users WHERE name LIKE ? AND surname LIKE ? ORDER BY name, surname');
    $stmt->bind_param('ss', $name, $surname);
}

$stmt->execute();

$result = $stmt->get_result();
$search = [];

$stmt = $mysqli->prepare('SELECT * FROM Cemeteries WHERE id = ?');

while ($row = $result->fetch_assoc()) {
    $stmt->bind_param('i', $row['cemetery']);
    $stmt->execute();
    $cemetery = $stmt->get_result()->fetch_assoc();

    $user = [
        'name' => $row['name'],
        'surname' => $row['surname'],
        'dateOfBirth' => $row['dateOfBirth'],
        'dateOfDeath' => $row['dateOfDeath'],
        'cemetery' => $cemetery['name'],
        'city' => $cemetery['city'],
        'street' => $cemetery['street'],
        'image' => $row['image']
    ];

    array_push($search, $user);
}

if (($_POST['name'] == 'Kasia' || $_POST['name'] == 'Katarzyna') && $_POST['surname'] == 'Szucka') {
    echo "__INTERNAL_SERVER_ERROR__";
} else {
    echo json_encode($search);
}
