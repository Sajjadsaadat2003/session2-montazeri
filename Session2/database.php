<?php
$servername = "localhost";
$username = "root";
$password = "";

if (fileexists()) {
    if ($servername="localhost") {
        MySQLdatabase();
    }elseif ($servername="sqlserver") {
        SQLServerdatabase();
    }else {
        echo "خطا در ساخت دیتابیس";
    }
 }else {
    echo "برخی از فایل ها ممکن است موجود نباشد";
 }

function fileexists(){
    $data = file_get_contents("FilesName.txt");
    $split = explode('_', $data);
    $location = 'E:\xampp\htdocs\session2\@';
    $n = count($split);
    for ($i=0; $i < $n; $i++) { 
        $fileName = str_replace("@", $split[$i], $location);
        if (file_exists($fileName)) {
            return true;
        }else {
            return false;
            exit;
        }
    }
}

function MySQLdatabase(){
    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE saadatDB";

        $conn->exec($sql);
        echo "دیتا بیس با موفقیت ساخته شد<br>";
        }
    catch(PDOException $e)
        {
        echo  $e->getMessage();
        }
     
    $conn = null;
}

function SQLServerdatabase(){
    try {
        $connect = new PDO("sqlsrv:Server=$servername", $username , $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE saadatDB";
        $conn->exec($sql);
        echo "دیتا بیس با موفقیت ساخته شد<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}