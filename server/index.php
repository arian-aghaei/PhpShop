<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$server = 'localhost';
$user = 'arian';
$pass = 'password';
$db = 'shop';

$conn = new mysqli($server, $user, $pass,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}