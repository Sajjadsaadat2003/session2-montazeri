<?php
include 'install.php';

$dsn = 'mysql:host=localhost;dbname=MyProjectDB';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql = 'CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        firstname VARCHAR(15) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول کاربران -';
}

try {
    $sql = 'CREATE TABLE post (
        id INT NOT NULL AUTO_INCREMENT,
        title VARCHAR(20) NOT NULL,
        textful VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول پست ها -' ;
}