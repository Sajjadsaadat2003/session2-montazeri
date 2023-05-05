<?php

session_start();
include 'install.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //بررسی اینکه حتما تمامی فیلد ها ارسال شده باشند
    if (isset($_POST['nationalcode']) and isset($_POST['Fname']) and isset($_POST['Lname']) and isset($_POST['Pnumber']) and isset($_POST['password']) and isset($_POST['Rpassword'])) {
        //بررسی اینکه فیلدی خالی نباشد
        if (!empty($_POST['nationalcode']) and !empty($_POST['Fname']) and !empty($_POST['Lname']) and !empty($_POST['Pnumber']) and !empty($_POST['password']) and !empty($_POST['Rpassword'])) {
            //هش کردن پسورد
            $hashed_password = md5($_POST['password']);
            if (isset($_POST['register'])) {//اجرای دستورات مربوطه در صورتی که اطلاعات صفحه رجیستر ارسال شده باشند
                $Fname = $_POST['Fname'];
                $Lname = $_POST['Lname'];
                $Phone = $_POST['Pnumber'];
                $Ncode = $_POST['nationalcode'];
                //دو متغیر شماره همراه و کدملی را گرفته و شماره اول انها را داخل یک متغیر دیگر میریزد
                $Phone09 = substr($Phone, 0, 2);
                $Ncode0 = substr($Ncode, 0, 1);
                $Ncode00 = substr($Ncode, 0, 2);
                $password = $_POST['password'];
                
                //بررسی اینکه حتما نام و نام خانوادگی فارسی باشد
                if (preg_match("#[a-zA-Z0-9]+#", $Fname) or preg_match("#[a-zA-Z0-9]+#", $Lname)) {
                    echo "<h1 style='text-align:center; color:red; padding:20%'>!!لطفا فقط از حروف فارسی استفاده کنید</h1>";
                } else {
                    //بررسی اینکه حتما کدملی و شماره همراه عدد باشد
                    if (!is_numeric($Phone) or !is_numeric($Ncode)) {
                        echo "<h1 style='text-align:center; color:red; padding:20%'>!!لطفا برای شماره همراه و کدملی از عدد استفاده کنید</h1>";
                    //بررسی اینکه شماره همراه با 09 و کدملی با 0 شروع شوند
                    } elseif ($Phone09 != "09" or $Ncode0 != "0" or $Ncode00 =="00") {
                        echo "<h1 style='text-align:center; color:red; padding:20%'>!!فرمت وارد شده برای تلفن همراه یا کدملی اشتباه است. (باید تلفن همراه با 09 و کدملی با یک صفر آغاز شود)</h1>";
                    } else {
                        //بررسی اینکه رمزعبور با تکرارش مطابقت داشته باشد
                    if ($_POST['password']!=$_POST['Rpassword']) {
                        echo "<h1 style='text-align:center; color:red; padding:20%'>!!رمزعبور با تکرارش مطابقت ندارد</h1>";
                    } else {
                        //بررسی اینکه رمز عبور حداقل 8 کاراکتر باشد
                        if (strlen($password) < 8) {
                            echo "<h1 style='text-align:center; color:red; padding:20%'>رمز عبور باید حداقل 8 کاراکتر باشد</h1>";
                        } elseif (!preg_match("#[0-9]+#", $password)) {//بررسی اینکه از عدد در پسورد استفاده شده باشد
                            echo "<h1 style='text-align:center; color:red; padding:20%'>رمزعبور باید شامل حداقل یک عدد باشد</h1>";
                        } elseif (!preg_match("#[a-zA-Z]+#", $password)) {//بررسی اینکه از حروف انگلیسی در پسورد استفاده شده باشد
                            echo "<h1 style='text-align:center; color:red; padding:20%'>رمزعبور باید شامل حداقل یک حرف انگلیسی باشد</h1>";
                        } elseif (!preg_match("#[$&!@+*]#", $password)) {//بررسی اینکه از نماد مشخص در پسورد استفاده شده باشد
                            echo "<h1 style='text-align:center; color:red; padding:20%'>رمزعبور باید شامل حداقل یک نماد ($ & ! @ + *) باشد</h1>";
                        } else {
                            //در صورت درست بودن تمامی شرط ها اطلاعات به تابع رجیستر ارسال میشود
                            if (register($_POST['nationalcode'], $_POST['Fname'], $_POST['Lname'], $_POST['Pnumber'], $hashed_password, $hashed_password)) {
                                header("location: dashboard.php");
                                exit;
                            } else {
                                echo "<h1 style='text-align:center; color:red; padding:20%'>.شما از قبل ثبت نام شده اید! لطفا وارد شوید</h1>";
                                exit;
                            }
                        }
                    }   
                }
            }
            //اجرای دستورات مربوطه در صورتی که اطلاعات صفحه لاگین ارسال شده باشند
            } elseif (isset($_POST['login'])) {
                if (login($_POST['username'], md5($_POST['password']))) {
                    header("location: dashboard.php");
                    exit;
                } else {
                    header("location: login.php?s=0");
                    exit;
                }
            }
        }
    }
}

//تابعی که بررسی میکند ایا کدملی از قبل در دیتابیس وجود دارد یا نه
function isUserExists($nationalcode)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE nationalcode = :nationalcode";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nationalcode' => $nationalcode]);
    return $stmt->rowCount();
}

//تابعی که اطلاعات رجیستر را درون دیتابیس قرار میدهد
function register($nationalcode, $Fname, $Lname, $Pnumber, $password, $Rpassword)
{
    global $pdo;
    if (isUserExists($nationalcode)) {
        return false;
    }
    $sql = "INSERT INTO users (nationalcode, Fname, Lname, Pnumber, password, Rpassword) VALUES (:nationalcode, :Fname, :Lname, :Pnumber, :password, :Rpassword)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':nationalcode' => $nationalcode, ':Fname' => $Fname, ':Lname' => $Lname, ':Pnumber' => $Pnumber, ':password' => $password, ':Rpassword' => $Rpassword]);
    return $stmt->rowCount();
}

//تابعی که شروط لاگین شدن را بررسی میکند
function login($username, $password)
{
    global $pdo;
    if (!isUserExists($username)) {
        return false;
    }
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['login'] = $result->id;
    return true;
}