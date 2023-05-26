<?php
session_start();
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['nationalcode'], $_POST['Pnumber'], $_POST['Rpassword'])) {
                    header("location: login.php");
                    exit;
                } else {
                    header("location: register.php?s=0");
                    exit;
                }
            } elseif (isset($_POST['login'])) {
                if (login($_POST['username'], $_POST['password'])) {
                    header("location: login.php?s=1");
                    exit;
                } else {
                    header("location: login.php?s=0");
                    exit;
                }
            }
        }
    }elseif (isset($_POST['title']) and isset($_POST['textful'])) {
        if (!empty($_POST['title']) and !empty($_POST['textful'])) {
            if (isset($_POST['createpost'])) {
                if (createpost($_POST['title'], $_POST['textful'])) {
                    header("location: createpost.php?s=1");
                    exit;
                } else {
                    header("location: createpost.php?s=0");
                    exit;
                }
            }
        }
    }
}

//////بررسی رجود یوزرنیم///////
function isUserExists($username)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}

////ارسال اطلاعات به دیتابیس////
function register($username, $password, $firstname, $lastname)
{
    global $pdo;
    if (isUserExists($username)) {
        return false;
    }
    $sql = "INSERT INTO users (username, password, firstname, lastname) VALUES (:username, :password, :firstname, :lastname)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':username' => $username, ':password' => md5($password), ':firstname' => $firstname, ':lastname' => $lastname]);
    return $stmt->rowCount();
}

////بازخوانی اطلاعات از دیتابیس////
function login($username, $password)
{
    global $pdo;
    if (!isUserExists($username)) {
        return false;
    }
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => md5($password)]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['login'] = $result->id;
    return true;
}

////ارسال اطلاعات پست جدید////
function createpost($title, $textful)
{
    global $pdo;
    $sql = "INSERT INTO post (title, textful) VALUES (:title, :textful)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':title' => $title, ':textful' => $textful]);
    return $stmt->rowCount();
}