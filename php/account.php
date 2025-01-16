<?php

session_start();

if (
    !isset($_SESSION['logged']) ||
    !isset($_SESSION['PESEL']) ||
    !isset($_POST['name']) ||
    !isset($_POST['surname']) ||
    !isset($_POST['dateOfBirth']) ||
    !isset($_POST['dateOfDeath']) ||
    !isset($_POST['cemetery'])
) {
    header('Location: ../login.php');
    die();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/hash.php';

$PESEL = $_SESSION['PESEL'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$dateOfBirth = $_POST['dateOfBirth'];
$dateOfDeath = $_POST['dateOfDeath'];
$cemetery = $_POST['cemetery'];

$stmt = $mysqli->prepare('UPDATE Users SET name = ?, surname = ?, dateOfBirth = ?, dateOfDeath = ?, cemetery = ?, password = ? WHERE PESEL = ?');
$stmt->bind_param('ssssiss', $name, $surname, $dateOfBirth, $dateOfDeath, $cemetery, $password, $PESEL);
$stmt->execute();
