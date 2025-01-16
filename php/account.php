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

$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". $secretKey ."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
$googleobj = json_decode($response);
$verified = $googleobj->success;
if ($verified == false){
  die('nie');
}

$stmt = $mysqli->prepare('UPDATE Users SET name = ?, surname = ?, dateOfBirth = ?, dateOfDeath = ?, cemetery = ?, password = ? WHERE PESEL = ?');
$stmt->bind_param('ssssiss', $name, $surname, $dateOfBirth, $dateOfDeath, $cemetery, $password, $PESEL);
$stmt->execute();
