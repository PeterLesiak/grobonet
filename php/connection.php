<?php

$username = 'lesiakp_grobonet';
$password = '123grobonet123';
$database = 'lesiakp_grobonet';

$mysqli = @new mysqli('spu.tkk.local', $username, $password, $database);

if ($mysqli->connect_error) {
    $mysqli = new mysqli('spu.technikumpolna.pl', $username, $password, $database);
}
