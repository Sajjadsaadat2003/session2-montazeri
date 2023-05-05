<?php
include 'database.php';

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "saadatDB";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//ساخت جدول در دیتابیس
$sql = "CREATE TABLE users (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nationalcode INT(10) NOT NULL,
Fname VARCHAR(15) NOT NULL,
Lname VARCHAR(30) NOT NULL,
Pnumber INT(11) NOT NULL,
password VARCHAR(255) NOT NULL,
Rpassword VARCHAR(255) NOT NULL,
)";

$conn->exec($sql);
echo "Table MyGuests created successfully";
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>