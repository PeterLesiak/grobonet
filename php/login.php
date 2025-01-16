<?php

if (!isset($_POST['PESEL']) || !isset($_POST['password'])) {
    header('Location: ../login.php');
    die('🤬🤬!!#1#1!!');
}

session_start();

if (isset($_SESSION['logged']) && isset($_SESSION['PESEL'])) {
  header('Location: ../account.php');
  die();
}

unset($_SESSION['invalid']);
unset($_SESSION['logged']);
unset($_SESSION['PESEL']);

require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/hash.php';

$PESEL = $_POST['PESEL'];
$password = $_POST['password'];
$verysecurepassword = caesarCipher($password, 1);

$stmt = $mysqli->prepare('SELECT * FROM Users WHERE PESEL = ? AND password = ?');
$stmt->bind_param('ss', $PESEL, $verysecurepassword);
$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();

if ($result) {
    $_SESSION['logged'] = true;
    $_SESSION['PESEL'] = $PESEL;

    header('Location: ../account.php');
    die();
} else {
    $stmt = $mysqli->prepare('SELECT * FROM Users WHERE PESEL = ?');
    $stmt->bind_param('s', $PESEL);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $_SESSION['invalid'] = 'password';
    } else {
        $_SESSION['invalid'] = 'all';
    }

    header('Location: ../login.php');
    die();
}
