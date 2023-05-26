<?php

$dsn = 'mysql:host=localhost';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $pdo->exec('CREATE DATABASE MyProjectDB');
} catch (PDOException $e) {
    echo '- خطا در ساخت دیتابیس - ';
}

?>